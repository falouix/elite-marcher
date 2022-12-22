<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DossiersAchat;
use App\Traits\ApiResponser;
use App\Repositories\Interfaces\IDossierARepository;
use App\Common\Utility;
use Log;

use Auth;
use DB;

class CustomerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(IDossierARepository $repository)
    {
        $this->middleware('auth:client');
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get infos by current year
        $annee_gestion = strftime('%Y');
        $client_id = Auth::user()->id;
        $count_dossiers = DossiersAchat::Select('id')->where('soumissionaire_id', $client_id)->where('annee_gestion', $annee_gestion)->count();
        $count_dossiersEncours = DossiersAchat::Select('id')
            ->where('soumissionaire_id', $client_id)
            ->where('situation_dossier', 4)
            ->where('annee_gestion', $annee_gestion)
            ->count();

        $count_dossiersFini = DossiersAchat::Select('id')
            ->where('soumissionaire_id', $client_id)
            ->where('situation_dossier', 7)
            ->where('annee_gestion', $annee_gestion)
            ->count();

        $count_dossiersAnnuler = DossiersAchat::Select('id')
            ->where('soumissionaire_id', $client_id)
            ->where('situation_dossier', 8)
            ->where('annee_gestion', $annee_gestion)
            ->count();

        // 1 :
        $count_dossiersGroupedConsultation = DB::table('dossiers_achats')
            ->select('situation_dossier', DB::raw('count(situation_dossier) as totalBySituation'))
            ->where('soumissionaire_id', $client_id)
            ->where('type_dossier', 'CONSULTATION')
            ->groupBy('situation_dossier')
            ->get();
        $count_dossiersGroupedAon = DB::table('dossiers_achats')
            ->select('situation_dossier', DB::raw('count(situation_dossier) as totalBySituation'))
            ->where('soumissionaire_id', $client_id)
            ->where('type_dossier', 'AON')
            ->groupBy('situation_dossier')
            ->get();
        $count_dossiersGroupedAos = DB::table('dossiers_achats')
            ->select('situation_dossier', DB::raw('count(situation_dossier) as totalBySituation'))
            ->where('soumissionaire_id', $client_id)
            ->where('type_dossier', 'AOS')
            ->groupBy('situation_dossier')
            ->get();
        $count_dossiersGroupedGreGre = DB::table('dossiers_achats')
            ->select('situation_dossier', DB::raw('count(situation_dossier) as totalBySituation'))
            ->where('soumissionaire_id', $client_id)
            ->where('type_dossier', 'AOGREGRE')
            ->groupBy('situation_dossier')
            ->get();
        //  return view('pdf.print');
        //dd($count_dossiersGroupedConsultation);
        return view('customer.index', compact('count_dossiersAnnuler', 'count_dossiersFini', 'count_dossiersEncours', 'count_dossiers', 'count_dossiersGroupedConsultation', 'count_dossiersGroupedAon', 'count_dossiersGroupedAos', 'count_dossiersGroupedGreGre'));
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $dossier = $this->repository->getDossierWithRelations($id);

        switch ($dossier->type_demande) {
            case '1':
                $dossier->type_demande = "مواد وخدمات";
                break;
            case '2':
                $dossier->type_demande = "أشغال";
                break;
            default:
                $dossier->type_demande = "دراسات";
                break;
        }
        switch ($dossier->type_dossier) {
            case 'CONSULTATION':
                return view('dossiers_achats.consultations.show', compact('dossier'));
            case 'AOS':
                return view('dossiers_achats.AOS.show', compact('dossier'));
            case 'AON':
                return view('dossiers_achats.AON.show', compact('dossier'));
            case 'AOGREGRE':
                return view('dossiers_achats.AOGREGRE.show', compact('dossier'));
        }
    }


    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllDossiersDatatable(Request $request)
    {
        Log::alert("DossierAchats client Request Params from view");
        Log::info($request);
        if ($request->annee_gestion) {
            if ($request->ajax()) {
                return $this->repository->getAllDossierACustomer($request->annee_gestion,
                $request->situation_dossier, $request->type_demande, $request->type_dossier, Auth::user()->id);
            }
        }

    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOffresDatatable(Request $request)
    {
        Log::alert("Offres- DossierAchat client Request Params from view");
        Log::info($request);
            if ($request->ajax()) {
                return $this->repository->getOffres($request->dossiers_id);
            }
    }
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCCDocsDatatable(Request $request)
    {
        Log::alert("CC Docs- DossierAchat client Request Params from view");
        Log::info($request);
            if ($request->ajax()) {
                return $this->repository->getCCDocs($request->idCC, $action ="file");
            }
    }
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLigneDossierADataTable(Request $request)
    {
        Log::alert("Ligne Dossier client Request Params from view");
        Log::info($request);
        if ($request->ajax()) {
            if ($request->dossiers_id) {
                    return $this->repository->getLigneDossierAsByDossierA($request->dossiers_id);
                }
        }

    }

}
