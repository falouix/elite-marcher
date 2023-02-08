<?php

namespace App\Http\Controllers;


use App\Models\Projet;
use App\Models\LignesProjet;
use App\Models\Service;
use App\Models\LignesBesoin;
use App\Models\DossiersAchat;
use App\Repositories\IFileUploadRepository;
use App\Repositories\Interfaces\IProjetRepository;
use App\Repositories\Interfaces\INotifRepository;
use App\Traits\ApiResponser;
use Auth;
use Illuminate\Http\Request;
use Log;
use DB;
use App\Common\Utility;

class PPMController extends Controller
{
    use ApiResponser;
    public function __construct(IProjetRepository $repository, INotifRepository $notifRepository)
    {
        $this->repository = $repository;
        $this->notifRepository = $notifRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('projets.ppm.index',);
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
        $projet = Projet::select('*')->where('id', $id)->first();
        return view('projets.ppm.edit', compact('projet'));
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
         $this->notifRepository->GenererNotifPPM($ppm);
         // Generate new notifs
         
         $notification =  $this->notifyArr('تحيين المخطط السنوي للشراءات', '!تم تحيين المخطط التقديري السنوي لإبرام الصفقات العمومية بنجاح', 'success', true);

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
    public function printPPM(Request $request){
        $ppm = $this->repository->getAllProjetToPrint($request->print_annee_gestion, 'all', $request->print_type_demande, 'all', "ppm");
        $annee_gestion = $request->print_annee_gestion;
        if($ppm->count()>0){
            return view('pdf.ppm', compact('ppm','annee_gestion'));
        }
    }
}
