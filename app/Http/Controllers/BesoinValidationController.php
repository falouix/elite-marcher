<?php

namespace App\Http\Controllers;

use App\Models\Besoin;
use App\Models\LignesBesoin;
use App\Models\Service;
use App\Models\Notif;
use App\Repositories\IFileUploadRepository;
use App\Repositories\Interfaces\IBesoinRepository;
use App\Repositories\Interfaces\INotifRepository;
use App\Traits\ApiResponser;
use Auth;
use Illuminate\Http\Request;
use Log;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Config;
use Carbon\Carbon;
use App\Common\Utility;

class BesoinValidationController extends Controller
{
    use ApiResponser;
    public function __construct(IBesoinRepository $repository, INotifRepository $notifRepository)
    {
        $this->repository = $repository;
        $this->notifRepository = $notifRepository;
      //  $this->settings = Etablissement::first();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->user_type == 'user') {
            $services = Service::select('id', 'libelle')->where('id', Auth::user()->services_id)->get();
        }
        if (Auth::user()->user_type == 'admin') {
            $services = Service::select('id', 'libelle')->get();
        }
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
         // Prevent XSS Attack
         Utility::stripXSS($request);
        $this->validate($request, [
            'date_besoin' => 'required|date',
            'annee_gestion' => 'required|min:4|max:4',
        ]);
        $user = $this->repository->update($request, $id);
        $notification = $this->notifyArr('', '!تم تحيين الحاجيات بنجاح', 'success', true);
        return redirect()->route('besoins-validation.index')
            ->with('notification', $notification);
    }
        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function validerBesoin(Request $request)
    {
         // Prevent XSS Attack
         Utility::stripXSS($request);
        Log::info("Validation besoin " .$request->id);

            $validator = Validator::make($request->all(), [
                'besoins_id' => 'required', // besoins_id
                'file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
            ]);
            if ($validator->fails()) {
                return $this->error($validator->errors(), 403);
            }
         // ajout de document s'il existe
         $besoin = Besoin::select('*')->find($request->besoins_id);
            if ($besoin) {
                $fileName = 'besoin_doc_validation' . time() . '.' . $request->file->extension();
                $path = 'app/documents/' . Config::get('constants.besoin_documents') . '/' . $request->besoins_id . '/';
                $request->file->move(storage_path($path), $fileName);
                $besoin->doc_validation =  $path . $fileName;
                $besoin->valider = 1;
                $besoin->save();

                $service = (Service::select('libelle')->where('id', $besoin->services_id)->first()->libelle) ?? '';
                // if notif_validation_besoins is true the Generate Notif
                $msg = "قام المستعمل [". Auth::user()->name ."]يالمصادقة على الحاجيات الخاصة بالمصلحة[ ".$service."]";
                // Create Notification To users
                $newNotif = new Notif();
                $newNotif->type = "MESSAGE";
                $newNotif->texte = $msg;
                $newNotif->from_table = "besoins";
                $newNotif->from_table_id = $besoin->id;
                $newNotif->users_id = Auth::user()->id;
                $newNotif->read_at = Carbon::now()->format('d-m-Y');
                $newNotif->action = route('pais.index');
                $notif = $this->notifRepository->GenererNotif($newNotif);
            }
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
         // Prevent XSS Attack
         Utility::stripXSS($request);
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
