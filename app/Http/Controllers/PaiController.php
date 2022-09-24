<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Repositories\Interfaces\IPaiRepository;
use Illuminate\Http\Request;
use Log;

class PaiController extends Controller
{
    public function __construct(IPaiRepository $repository)
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
        return view('besoins.pais.index', compact('services'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPais()
    {
        $services = Service::select('id', 'libelle')->get();
        return view('besoins.pais.index-pais', compact('services'));
    }



    // المخطط السنوي للحاجيات
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllPaiDatatable(Request $request)
    {
        Log::alert("Pai Request Params from view");
        Log::info($request);
        if($request->annee_gestion){
            if ($request->ajax()) {
                return $this->repository->getPAI($request->services_id, $request->annee_gestion,
                                                $request->type_demande, $request->nature_demande, $request->mode);
            }
        }

    }
    // المخطط السنوي للشراءات
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllPaiProjetDatatable(Request $request)
    {
        Log::alert("Pai Projet Request Params from view");
        Log::info($request);
        if($request->annee_gestion){
            if ($request->ajax()) {
                return $this->repository->getPAIProjets($request->services_id, $request->annee_gestion,
                                                $request->type_demande, $request->nature_demande);
            }
        }

    }

}
