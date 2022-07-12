<?php

namespace App\Http\Controllers;

use App\Models\Besoin;
use App\Models\LignesBesoin;
use App\Models\Service;
use App\Repositories\IFileUploadRepository;
use App\Repositories\Interfaces\IBesoinRepository;
use App\Traits\ApiResponser;
use Auth;
use Illuminate\Http\Request;
use Log;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;

class BesoinValidationController extends Controller
{
    use ApiResponser;
    public function __construct(IBesoinRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::select('id', 'libelle')->get();
        return view('besoins.validation.index', compact('services'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $besoin = $this->repository->getBesoinByParam('id', $id);
        $userService = Service::select('*')->where('id', $besoin->services_id)->first();
        //dd($besoin);
        return view('besoins.validation.edit', compact('userService', 'besoin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'date_besoin' => 'required|date',
            'annee_gestion' => 'required|min:4|max:4',
        ]);
        $user = $this->repository->update($request, $id);
        $notification = $this->notifyArr('', '!تم تحيين ضبط الحاجيات بنجاح', 'success', true);
        return redirect()->route('besoins-validation.index')
            ->with('notification', $notification);
    }
        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function validerBesoin($id)
    {
        Log::info("Validation besoin " .$id);
        $this->repository->validerBesoin($id);
        return $this->notify('المصادقة على الحاجيات', 'تمت المصادقة على الحاجيات  بنجاح');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLigneBesoinsByBesoin(Request $request)
    {
        Log::info("controller");
        Log::info($request);
        if ($request->ajax()) {
            return $this->repository->getLigneBesoinsByBesoin($request->besoins_id, $request->mode);
        }
    }

    // Edit Ligne Besoin from table
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editLigneBesoin(Request $request)
    {
        if ($request->ajax()) {
            return LignesBesoin::select('*')->where('id', $request->id)->first();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CasePartie  $pris
     * @return \Illuminate\Http\Response
     */
    public function updateLigneBesoin(Request $request)
    {
        Log::info($request);

        if ($request->ajax()) {
            LignesBesoin::find($request->id)->update([
                'qte_valide' => $request->qte_valide,
                'cout_unite_ttc' => $request->cout_unite_ttc,
                'cout_total_ttc' => $request->qte_valide * $request->cout_unite_ttc,
            ]);
            return $this->notify('ضبط الحاجيات', '!تم تحيين للحاجيات بنجاح', 'success', true);
        } else {
            return $this->notify('!  خطأ', 'خطأ عند تحيين الحاجيات', 'error');
        }
    }
}
