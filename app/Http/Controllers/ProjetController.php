<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\Service;
use App\Repositories\IFileUploadRepository;
use App\Repositories\Interfaces\IProjetRepository;
use App\Traits\ApiResponser;
use Auth;
use Illuminate\Http\Request;
use Log;

class ProjetController extends Controller
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
        if (Auth::user()->user_type == 'user') {
            $services = Service::select('id', 'libelle')->where('id', Auth::user()->services_id)->get();
        }
        if (Auth::user()->user_type == 'admin') {
            $services = Service::select('id', 'libelle')->get();
        }
        return view('projets.index', compact('services'));
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
            'objet' => 'required',
        ]);
        $projet = $this->repository->create($request->all());
       // dd($projet);
       if($projet){
        // create ligne projet
       }
        $notification = $this->notifyArr('إضافة الحاجيات', '!تم إضافة الحاجيات بنجاح', 'success', true);

        return redirect()->route('besoins.index')
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
        //
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
        $Service = Service::select('*')->where('id', $projet->services_id)->first();
        return view('besoins.edit', compact('Service', 'projet'));
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
}
