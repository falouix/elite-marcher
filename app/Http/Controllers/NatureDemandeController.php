<?php

namespace App\Http\Controllers;

use App\Models\NatureDemande;
use App\Repositories\Interfaces\INatureDemandeRepository;
use App\Traits\ApiResponser;
use Auth;
use Illuminate\Http\Request;
use Log;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Carbon\Carbon;

class NatureDemandeController extends Controller
{
    use ApiResponser;

    public function __construct(INatureDemandeRepository $repository)
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
        //dd(NatureDemande::select('id', 'libelle')->where('id', 1)->first());
        return view('natures_demande.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'libelle' => 'required|unique:nature_demandes,libelle',
        ]);
        if ($validator->fails()) {
            return $this->error($validator->errors(), 403);
        }

        $this->repository->create($request->all());

        return $this->notify('إضافة نوع طلب', '!تم إضافة نوع طلب جديد بنجاح', 'success', true);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NatureDemande  $NatureDemande
     * @return \Illuminate\Http\Response
     */
    public function show(NatureDemande $NatureDemande)
    {
       // $NatureDemande = NatureDemande::find($NatureDemande->id);
        // return view('NatureDemandes.show', compact('NatureDemande'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NatureDemande  $NatureDemande
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if ($request->ajax()) {
            $NatureDemande = NatureDemande::find($id);
            return response()->json($NatureDemande);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NatureDemande  $NatureDemande
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Log::alert($id);

        $validator = Validator::make($request->all(), [
            'libelle' => 'required|unique:nature_demandes,libelle,' . $id,

        ]);
        if ($validator->fails()) {
            return $this->error($validator->errors(), 403);
        }

        $input = $request->all();

        $NatureDemande = NatureDemande::find($id);
        $NatureDemande->update($input);

        return $this->notify('إشعار', 'تم تعديل توع الطلب بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NatureDemande  $NatureDemande
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->destroy($id);

        return $this->notify('إشعار', 'تم حذف نوع طلب بنجاح');
    }

    public function multidestroy(Request $request)
    {

        $ids = $request->ids;
        // Log::info(count($request->ids));
        NatureDemande::whereIn('id', $request->ids)->delete();


        return $this->notify('!حذف نوع طلب', 'تم حذف أنواع الطلب بنجاح');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllNatureDemandeDataTable()
    {
        return $this->repository->getAllNatureDemande();
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllNatureDemandeToSelect(Request $request)
    {
        if ($request->ajax()) {
            return $this->repository->getNatureDemandeSelect($request->type);
        }
    }
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNatureDemandeById(Request $request)
    {
        //if ($request->ajax()) {
        return NatureDemande::select('id', 'libelle')->where('id',$request->nature_demandes_id)->first();
    }

}
