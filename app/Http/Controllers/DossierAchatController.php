<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DossiersAchat;
use App\Traits\ApiResponser;
use App\Repositories\Interfaces\IDossierARepository;
use Log;

class DossierAchatController extends Controller
{
    use ApiResponser;
    public function __construct(IDossierARepository $repository)
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dossier = $this->repository->getDossierWithRelations($id);
       // dd($dossier);
        return view('dossiers_achats.show',compact('dossier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dossier = $this->repository->getDossierWithRelations($id);
        return view('dossiers_achats.show',compact('dossier'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllDossiersDatatable(Request $request)
    {
        Log::alert("DossierAchats Request Params from view");
        Log::info($request);
        if ($request->annee_gestion) {
            if ($request->ajax()) {
                return $this->repository->getAllDossierA($request->annee_gestion, $request->situation_dossier, $request->type_demande, $request->type_dossier);
            }
        }

    }
}
