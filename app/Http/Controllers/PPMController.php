<?php

namespace App\Http\Controllers;

use App\Models\Periodes;
use Illuminate\Http\Request;
use App\Common\Utility;
use App\Models\{
    DossiersAchat,Projet,Etablissement,Notif
};
use App\Repositories\Interfaces\{
    INotifRepository,IProjetRepository
};
use App\Traits\ApiResponser;
use Auth;
use Carbon\Carbon;
use Log;

class PPMController extends Controller
{
    use ApiResponser;
    public function __construct(IProjetRepository $repository, INotifRepository $notifRepository)
    {
        $this->repository = $repository;
        $this->notifRepository = $notifRepository;
        $this->settings = Etablissement::first();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('projets.ppm.index', );
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projet = Projet::select('*')->where('id', $id)->first();
        return view('projets.ppm.show', compact('projet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $periodes = Periodes::select('*')->get();
        $projet = Projet::select('*')->where('id', $id)->first();
        return view('projets.ppm.edit', compact('projet','periodes'));
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
        $ppm = $this->repository->updatePPM($request->all(), $id);
       // dd($ppm);
        // Generate new notifs
        if($this->settings->notif_cc){
            $codedossier= (DossiersAchat::select('code_dossier')->where('code_projet', $ppm->code_projet)->first()->code_projet) ?? '';
            // if notif_validation_besoins is true the Generate Notif
            $msg = "تذكير بموعد البدأ في إجراءات الملف عدد[" . $codedossier . "], التاريخ المتوقع لإعداد كراس الشروط [" . $ppm->date_cc_prvu . "]";
            // Create Notification To users
            $newNotif = new Notif();
            $newNotif->type = "MESSAGE";
            $newNotif->texte = $msg;
            $newNotif->from_table = "DossiersAchat";
            $newNotif->from_table_id = $ppm->id;
            $newNotif->users_id = Auth::user()->id;

            $dateavis = Carbon::createFromFormat('Y-m-d', $ppm->date_cc_prvu);
            $newNotif->read_at = $dateavis->subDays($this->settings->notif_duree_cc)->format('Y-m-d');
            /*switch ($ppm->type_dossier) {
                case 'CONSULTATION':
                    $newNotif->action = route('consultations.edit', ['consultation' => $dossierA->id]);
                    break;
                case 'AOS':
                    $newNotif->action = route('aos.edit', ['aos' => $dossierA->id]);
                    break;
                case 'AON':
                    $newNotif->action = route('aon.edit', ['aon' => $dossierA->id]);
                    break;
                case 'AOGREGRE':
                    $newNotif->action = route('aogregre.edit', ['aogregre' => $dossierA->id]);
                break;
            }*/
            $newNotif->action = "";
           // dd($newNotif);
            $notif = $this->notifRepository->GenererNotif($newNotif);
        }


        $notification = $this->notifyArr('تحيين المخطط السنوي للشراءات', '!تم تحيين المخطط التقديري السنوي لإبرام الصفقات العمومية بنجاح', 'success', true);
        return redirect()->route('ppm.index')
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
        //
    }
    // المخطط السنوي للشراءات
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllProjetsDatatable(Request $request)
    {
        Log::alert("PPM Projets Request Params from view");
        Log::info($request);
        if ($request->annee_gestion) {
            if ($request->ajax()) {
                return $this->repository->getAllProjet($request->annee_gestion, $request->services_id, $request->type_demande, $request->natures_passation, "ppm");
            }
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function printPPM(Request $request)
    {
        $ppm = $this->repository->getAllProjetToPrint($request->print_annee_gestion, 'all', $request->print_type_demande, 'all', "ppm");
        $annee_gestion = $request->print_annee_gestion;
        if ($ppm->count() > 0) {
            return view('pdf.ppm', compact('ppm', 'annee_gestion'));
        }
    }
}
