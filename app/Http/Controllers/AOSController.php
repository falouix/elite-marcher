<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\LignesProjet;
use App\Models\Service;
use App\Models\LignesBesoin;
use App\Models\DossiersAchat;
use App\Repositories\IFileUploadRepository;
use App\Repositories\Interfaces\IProjetRepository;
use App\Traits\ApiResponser;
use Auth;
use Illuminate\Http\Request;
use Log;
use DB;

class AOSController extends Controller
{
    use ApiResponser;
    public function __construct(IProjetRepository $repository, IFileUploadRepository $fileRepository)
    {
        $this->repository = $repository;
        $this->fileRepository = $fileRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$tot = LignesDossier::select('cout_total_ttc')->where('dossiers_achats_id',12)->sum('cout_total_ttc');
        //dd($tot);
        return view('dossiers_achats.AOS.index',);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->user_type == 'user') {
            $services = Service::select('id', 'libelle')->where('id', Auth::user()->services_id)->get();
        }
        if (Auth::user()->user_type == 'admin') {
            $services = Service::select('id', 'libelle')->get();
        }
        return view('projets.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'type_demande' => 'required',
            'nature_passation' => 'required',
            'services_id' => 'required',
            'date_action_prevu' => 'required',
            'annee_gestion' => 'required|max:4|min:4',
           // 'objet' => 'required',
        ]);
        $projet = $this->repository->create($request->all());
       //dd($projet);
       if($projet){
        // create ligne projet
        if ($request->lignesprjt) {
                foreach (json_decode($request->lignesprjt) as $item) {
                    $ligneBesoin = LignesBesoin::find($item);
                   // dd($ligneBesoin);
                    if($ligneBesoin){
                        LignesProjet::create([
                            'num_lot' => NULL,
                            'libelle' => ($ligneBesoin->libelle) ? $ligneBesoin->libelle : NULL,
                            'lignes_besoin_id' => $ligneBesoin->id,
                            'qte' => $ligneBesoin->qte_valide,
                            'cout_unite_ttc' =>$ligneBesoin->cout_unite_ttc,
                            'cout_total_ttc' => $ligneBesoin->cout_total_ttc,
                            //'type_demande' => $ligneBesoin->type_demande,
                            //'nature_demandes_id' => $ligneBesoin->nature_demandes_id,
                            'projets_id' => $projet->id,
                        ]);
                        $ligneBesoin->projets_id = $projet->id;
                        $ligneBesoin->save();
                    }
                }
        }
       }
        $notification = $this->notifyArr('إضافة مشروع شراء', '!تم إضافة مشروع شراء بنجاح', 'success', true);

        return redirect()->route('projets.index')
            ->with('notification', $notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         //$besoin = $this->repository->getBesoinByParam('id', $id);
         $projet = Projet::select('*')->where('id', $id)->first();
         if (Auth::user()->user_type == 'user') {
            $services = Service::select('id', 'libelle')->where('id', Auth::user()->services_id)->get();
        }
        if (Auth::user()->user_type == 'admin') {
            $services = Service::select('id', 'libelle')->get();
        }
         return view('projets.show', compact('services', 'projet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$besoin = $this->repository->getBesoinByParam('id', $id);
        $projet = Projet::select('*')->where('id', $id)->first();
        if (Auth::user()->user_type == 'user') {
            $services = Service::select('id', 'libelle')->where('id', Auth::user()->services_id)->get();
        }
        if (Auth::user()->user_type == 'admin') {
            $services = Service::select('id', 'libelle')->get();
        }
        return view('projets.edit', compact('Service', 'projet'));
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
            'type_demande' => 'required',
            'nature_passation' => 'required',
            'services_id' => 'required',
            'date_action_prevu' => 'required',
            'annee_gestion' => 'required|max:4|min:4',
            'objet' => 'required',
        ]);
        $projet = $this->repository->update($request->all());
        $notification = $this->notifyArr('تحيين مشروع شراء', '!تم تحيين مشروع شراء بنجاح', 'success', true);

        return redirect()->route('projets.index')
            ->with('notification', $notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->destroy($id);
        return $this->notify('مشروع شراء', 'تم حذف  مشروع الشراء بنجاح');
    }

    public function destroyLigneProjet(Request $request)
    {
        LignesProjet::find($request->id)->delete();

        return $this->notify('مشروع شراء', 'تم حذف المادة من مشروع الشراء بنجاح');

    }
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllProjetsDatatable(Request $request)
    {
        Log::alert("Pai Request Params from view");
        Log::info($request);
        if ($request->annee_gestion) {
            if ($request->ajax()) {
                return $this->repository->getAllProjet($request->annee_gestion, $request->services_id, $request->type_demande, $request->natures_passation);
            }
        }

    }
    /**
     * Process datatables LignesProjet ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLigneProjetsByProjet(Request $request)
    {
        Log::info("Ligne projet datatable");
        Log::info($request);
        if ($request->ajax()) {
            return $this->repository->getLigneProjetsByProjet($request->projet_id, $request->mode);
        }
    }

    /**
     * ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function transfererProjet(Request $request)
    {
        Log::info("Transfert projet to Dossier Achat");
        Log::info($request);
        if ($request->ajax()) {
            // create dossier achat
            $projet = Projet::find($request->projets_id);
            if($projet){
                $dossierAchat = DossiersAchat::create([
                    'code_projet'=> $projet->code_pa,
                    'annee_gestion'=> date('Y'),
                    'situation_dossier'=> 1,
                    'objet_dossier'=> $projet->objet,
                    'organisme_financier'=> $request->organisme_financier,
                    'source_finance'=> $request->source_finance,
                    'nature_finance'=> $request->nature_finance,
                    'type_dossier'=> $projet->nature_passation,
                    'type_demande'=> $projet->type_demande,
                    'type_commission'=>  $request->type_commission,
                ]);
                if ($dossierAchat){
                    $this->repository-> transfererProjet($projet->id, $dossierAchat->id);
                    return $this->notify('ملف شراء', 'تم تحويل المشروع إلى ملف شراء بنجاح');
                }
            }
        }
    }
}
