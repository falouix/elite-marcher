<?php

namespace App\Http\Controllers;

use App\Models\{DossiersAchat, LignesBesoin, LignesDossier,
    LignesDossiersAchat, Service,
     Notif, Soumissionnaire,
     CahiersCharge, TypesDoc, Projet, AvisDossier};
use App\Repositories\IFileUploadRepository;
use App\Repositories\Interfaces\{IConsultationRepository, IDossierARepository, INotifRepository};
use App\Traits\ApiResponser;
use Auth;
use Illuminate\Http\Request;
use Log;
use DB;
use Validator;
use Carbon\Carbon;
use App\Common\Utility;

class ConsultationController extends Controller
{
    use ApiResponser;
    public function __construct(IConsultationRepository $repository, IDossierARepository $dossierRepository, IFileUploadRepository $fileRepository, INotifRepository $notifRepository)
    {
        $this->repository = $repository;
        $this->dossierRepository = $dossierRepository;
        $this->fileRepository = $fileRepository;
        $this->notifRepository = $notifRepository;
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
        return view('dossiers_achats.consultations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->user_type == 'user') {
            $services = Service::select('id', 'libelle')
                ->where('id', Auth::user()->services_id)
                ->get();
        }
        if (Auth::user()->user_type == 'admin') {
            $services = Service::select('id', 'libelle')->get();
        }
        return view('projets.create', compact('services'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function cahierCharges(Request $request)
    {
        // Prevent XSS Attack
        Utility::stripXSS($request);
        if ($request->ajax()) {
            Log::info('Cahier des charges validation from edit consultation view');
            Log::info($request);

            $validator = Validator::make($request->all(), [
                'dossiers_achats_id' => 'required',
                'date_pub_prevu' => 'required|date',
                'duree_travaux' => 'required|numeric|min:1|max:999',
            ]);

            if ($validator->fails()) {
                return $this->error($validator->errors(), 403);
            }
            $cc = $this->dossierRepository->cahierCharges($request);
            return $this->notify('كراس الشروط', 'تم تسجيل بيانات كراس الشروط بنجاح', $type = 'success', $rtl = true, $cc);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function avisPub(Request $request)
    {
        // Prevent XSS Attack
        Utility::stripXSS($request);
        if ($request->ajax()) {
            Log::info('Avis Pub validation from edit consultation view');
            Log::info($request);
            $cc = CahiersCharge::where('dossiers_achats_id', $request['dossiers_achats_id'])->first();
            if ($cc) {
                $validator = Validator::make($request->all(), [
                    'dossiers_achats_id' => 'required',
                    'ref_avis' => 'required',
                    //'texte_avis' => 'required',
                    'destination' => 'required',
                    'date_debut_avis' => 'required|date_format:Y-m-d\TH:i',
                    'date_validite' => 'required|date_format:Y-m-d\TH:i',
                    'date_ouverture_plis' => 'required|date_format:Y-m-d\TH:i',
                    'duree_avis' => 'required|numeric|min:1|max:999',
                ]);

                if ($validator->fails()) {
                    Log::alert("message : ".$validator->errors());
                    return $this->error($validator->errors(), 403);
                }

                $avisPub = $this->dossierRepository->avisPub($request);
                return $this->notify('الإعلان الإشهاري', 'تم تسجيل بيانات الإعلان الإشهاري بنجاح', 'success', true, $avisPub);
            } else {
                return $this->notify('الإعلان الإشهاري', 'لا يمكن تسجيل الإعلان الإشهار قبل إعداد كراس الشروط','error', true);
            }
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Prevent XSS Attack
        Utility::stripXSS($request);
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
        if ($projet) {
            // create ligne projet
            if ($request->lignesprjt) {
                foreach (json_decode($request->lignesprjt) as $item) {
                    $ligneBesoin = LignesBesoin::find($item);
                    // dd($ligneBesoin);
                    if ($ligneBesoin) {
                        LignesDossiersAchat::create([
                            'num_lot' => null,
                            'libelle' => $ligneBesoin->libelle ? $ligneBesoin->libelle : null,
                            'lignes_besoin_id' => $ligneBesoin->id,
                            'qte' => $ligneBesoin->qte_valide,
                            'cout_unite_ttc' => $ligneBesoin->cout_unite_ttc,
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

        return redirect()
            ->route('projets.index')
            ->with('notification', $notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        /*->with('lignes_dossiers')
        ->with('cahiers_charges')
        ->with('dossier_docs')
        ->with('offres')
        ->with('service_ordres')
        ->with('enregistrements')
        ->with('bcs_engagements')
        ->with('avis_dossiers')*/
        $id = decrypt($id);
        $dossier = $this->dossierRepository->getDossierWithRelations($id, ['cahiers_charges', 'commissions_ops', 'commissions_techniques']);
        switch ($dossier->type_demande) {
            case '1':
                $dossier->type_demande = 'مواد وخدمات';
                break;
            case '2':
                $dossier->type_demande = 'أشغال';
                break;
            default:
                $dossier->type_demande = 'دراسات';
                break;
        }

        return view('dossiers_achats.consultations.show', compact('dossier'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCustomer(Request $request, $id)
    {
        /*->with('lignes_dossiers')
        ->with('cahiers_charges')
        ->with('dossier_docs')
        ->with('offres')
        ->with('service_ordres')
        ->with('enregistrements')
        ->with('bcs_engagements')
        ->with('avis_dossiers')*/
        $id = decrypt($id);
        $dossier = $this->dossierRepository->getDossierWithRelations($id, ['cahiers_charges', 'commissions_ops', 'commissions_techniques']);
        switch ($dossier->type_demande) {
            case '1':
                $dossier->type_demande = 'مواد وخدمات';
                break;
            case '2':
                $dossier->type_demande = 'أشغال';
                break;
            default:
                $dossier->type_demande = 'دراسات';
                break;
        }
        $client = Soumissionnaire::select('*')
            ->where('id', $dossier->soumissionaire_id)
            ->first();
        return view('dossiers_achats.consultations.show-customer', compact('dossier', 'client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {

        $id = decrypt($id);
        //$dossier = $this->dossierRepository->getDossierAByParam('id', $id);
        $dossier = $this->dossierRepository->getDossierWithRelations($id, ['cahiers_charges', 'avis_dossiers']);
        $projet = Projet::select('*')->where('code_pa',$dossier->code_projet)->first();
         if($dossier->cahierCharges == null){

            $cahiers_charges= new CahiersCharge();
            $cahiers_charges->dossiers_achats_id = $dossier->id;
            $cahiers_charges->duree_travaux= $projet->duree_travaux_prvu;
            $cahiers_charges->date_pub_prevu=$projet->date_cc_prvu;


         }else{
            $cahiers_charges= $dossier->cahierCharges;
         }
         if($dossier->avis_dossiers[0] == null){

            $avisDossier= new AvisDossier();
            $avisDossier->dossiers_achats_id = $dossier->id;
            $avisDossier->date_ouverture_plis=$projet->date_op_prvu;


         }else{
            $avisDossier= $dossier->avis_dossiers;
         }

        switch ($dossier->type_demande) {
            case '1':
                $dossier->type_demande = 'مواد وخدمات';
                break;
            case '2':
                $dossier->type_demande = 'أشغال';
                break;
            default:
                $dossier->type_demande = 'دراسات';
                break;
        }
        // Types Docs grouped by type
        $type_docs = DB::table('types_docs')->select('id','libelle', 'type_doc')
        ->get()->groupBy('type_doc');

        return view('dossiers_achats.consultations.edit', compact('dossier','type_docs','projet','cahiers_charges','avisDossier'));
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
            'type_demande' => 'required',
            'nature_passation' => 'required',
            'services_id' => 'required',
            'date_action_prevu' => 'required',
            'annee_gestion' => 'required|max:4|min:4',
            'objet' => 'required',
        ]);
        $projet = $this->repository->update($request->all());
        $notification = $this->notifyArr('تحيين مشروع شراء', '!تم تحيين مشروع شراء بنجاح', 'success', true);

        return redirect()
            ->route('projets.index')
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

    public function destroyLigneDossiersAchat(Request $request)
    {
        LignesDossiersAchat::find($request->id)->delete();

        return $this->notify('مشروع شراء', 'تم حذف المادة من مشروع الشراء بنجاح');
    }
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllDossiersAchatsDatatable(Request $request)
    {
        Log::alert('Pai Request Params from view');
        Log::info($request);
        if ($request->annee_gestion) {
            if ($request->ajax()) {
                return $this->repository->getAllDossiersAchat($request->annee_gestion, $request->services_id, $request->type_demande, $request->natures_passation);
            }
        }
    }
    /**
     * Process datatables LignesDossiersAchat ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLigneDossiersAchatsByDossiersAchat(Request $request)
    {
        Log::info('Ligne projet datatable');
        Log::info($request);
        if ($request->ajax()) {
            return $this->repository->getLigneDossiersAchatsByDossiersAchat($request->projet_id, $request->mode);
        }
    }
}
