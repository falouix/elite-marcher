<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DossiersAchat;
use App\Traits\ApiResponser;
use App\Repositories\Interfaces\IDossierARepository;
use Log;
use App\Common\Utility;

class DossierAchatController extends Controller
{
    use ApiResponser;
    public function __construct(IDossierARepository $repository)
    {
        $this->repository = $repository;
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
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
                return view('dossiers_achats.consultations.edit', compact('dossier'));
            case 'AOS':
                return view('dossiers_achats.AOS.index', compact('dossier'));
            case 'AON':
                return view('dossiers_achats.AON.index', compact('dossier'));
            case 'AOGREGRE':
                return view('dossiers_achats.AOGREGRE.index', compact('dossier'));
        }

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
                return $this->repository->getAllDossierA($request->annee_gestion,
                $request->situation_dossier, $request->type_demande, $request->type_dossier);
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
        Log::alert("Offres- DossierAchat Request Params from view");
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
        Log::alert("CC Docs- DossierAchat Request Params from view");
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
        Log::alert("Ligne Dossier Request Params from view");
        Log::info($request);
        if ($request->ajax()) {
            if ($request->dossiers_id) {
                    return $this->repository->getLigneDossierAsByDossierA($request->dossiers_id);
                }
        }

    }
}
