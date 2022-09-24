<?php

namespace App\Http\Controllers;

use App\Models\{
    Article,
    Besoin,
    LignesBesoin,
    Service,
    LignesProjet
};
use App\Repositories\IFileUploadRepository;
use App\Repositories\Interfaces\IBesoinRepository;
use App\Repositories\Interfaces\INatureDemandeRepository;
use App\Traits\ApiResponser;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Log;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;

class BesoinController extends Controller
{
    use ApiResponser;
    public function __construct(IBesoinRepository $repository, IFileUploadRepository $fileRepository, INatureDemandeRepository $natureDemandeRepository)
    {
        $this->repository = $repository;
        $this->fileRepository = $fileRepository;
        $this->natureDemandeRepository = $natureDemandeRepository;
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

        return view('besoins.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Create Record for besoin
        $besoin = Besoin::select('*')->where('services_id', Auth::user()->services_id)
            ->where('annee_gestion', strftime('%Y'))
            ->first();
        // Si besoin existe ouvrir on mode edition sinon create new besoin
        $userService = Service::select('*')->where('id', Auth::user()->services_id)->first();
        if (!$besoin) {
            $besoin = Besoin::create([
                'annee_gestion' => strftime('%Y'),
                'date_besoin' => Carbon::now()->format('d-m-Y'),
                'services_id' => Auth::user()->services_id,
            ]);

        }
        //dd($besoin);
        return view('besoins.edit', compact('userService', 'besoin'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $this->validate($request, [
            'date_besoin' => 'required',
            'annee_gestion' => 'required|max:4|min:4',
        ]);
        $besoin = $this->repository->create($request->all());
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
        $besoin = Besoin::select('*')->where('id', $id)->first();
        $userService = Service::select('*')->where('id', $besoin->services_id)->first();
        return view('besoins.edit', compact('userService', 'besoin'));
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
            'date_besoin' => 'required|date',
            'annee_gestion' => 'required|min:4|max:4',
        ]);

        $besoin = $this->repository->update($request, $id);
        /*$locale = LaravelLocalization::getCurrentLocale();
        if ($locale == 'en') {
        $notification = $this->notifyArr('Success [Update Client]', 'Client updated successfully!', 'success', false);
        } else {
         */
        $notification = $this->notifyArr('', '!تم تحيين ضبط الحاجيات بنجاح', 'success', true);
        //}

        return redirect()->route('besoins.index')
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
        return $this->notify('حذف الحاجيات', 'تم حذف الحاجيات  بنجاح');
    }
    //return besoin selected
    public function getBesoinSelected(Request $request)
    {
        $data = Besoin::find($request->id);
        return Response()->json($data);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllBesoinDatatable(Request $request)
    {
        Log::info($request);
        if ($request->ajax()) {
            return $this->repository->getAllBesoin($request->services_id, $request->annee_gestion, $request->status, $request->mode);
        }
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLigneBesoinsByBesoin(Request $request)
    {
        Log::info("Ligne besoin datatable");
        Log::info($request);
        if ($request->ajax()) {
            return $this->repository->getLigneBesoinsByBesoin($request->besoins_id, $request->mode);
        }
    }
    public function multidestroy(Request $request)
    {
        Log::info($request->ids);
        $this->repository->multiDestroy($request->ids);

        $locale = LaravelLocalization::getCurrentLocale();
        if ($locale == 'en') {
            return $this->notify('User delete', ' User(s) deleted successfully!', 'success', false);
        }
        return $this->notify('!حذف مستعمل', 'تم حذف المستعمل(ين) بنجاح');
    }

    // Edit Ligne Besoin from table
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editLigneBesoin(Request $request)
    {
        if ($request->ajax()) {
            return LignesBesoin::select('*')->with('document')->where('id', $request->id)->first();
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeLigneBesoin(Request $request)
    {
        Log::info("Store Ligne besoin");
        Log::info($request);
        if ($request->file == 'undefined') {
            $validator = Validator::make($request->all(), [
                'articles_id' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'articles_id' => 'required',
                'file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
            ]);
        }

        Log::info($validator->errors());
        if ($validator->fails()) {
            return $this->error($validator->errors(), 403);
        }
        if (!$request->qte_valide) {
            $request->qte_valide = 0;
        }
        if ($request->ajax()) {
            Log::info("Store Ligne besoin");
            Log::info($request);
            $ligneBesoin = LignesBesoin::select('id', 'articles_id')
                ->where('besoins_id', $request->besoins_id)
                ->where('articles_id', $request->articles_id)->first();
            Log::info("Exist Ligne besoin " . $ligneBesoin);
            if ($ligneBesoin) {
                return $this->notify('ضبط الحاجيات', 'هذه المادة موجودة سابقا ضمن الحاجيات.', 'error', true);
            }
            $article = Article::find($request->articles_id);
            $ligneBesoin = LignesBesoin::create([
                'libelle' => ($article != null) ? $article->libelle : null,
                'articles_id' => $request->articles_id,
                'description' => $request->description,
                'type_demande' => $request->type_demande,
                'nature_demandes_id' => $request->nature_demandes_id,
                'qte_demande' => $request->qte_demande,
                'cout_unite_ttc' => $request->cout_unite_ttc,
                'cout_total_ttc' => $request->qte_demande * $request->cout_unite_ttc,
                'qte_valide' => $request->qte_valide,
                'besoins_id' => $request->besoins_id,
            ]);
            // ajout de document s'il existe
            if ($request->file != 'undefined') {
                if ($ligneBesoin) {
                    $request['path'] = "besoin_documents";
                    $request['besoins_id'] = $ligneBesoin->id;
                    $file = $this->fileRepository->fileUploadPost($request);
                }
            }

            return $this->notify('ضبط الحاجيات', '!تم إضافة مادة جديدة للحاجيات بنجاح', 'success', true);
        } else {
            return $this->notify('ضبط الحاجيات', '!خطأ داخلي الرجاء إعادة المحاولة', 'error', true);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeLigneBesoinException(Request $request)
    {
        Log::info("Store Ligne besoin Exception - Projet Achat");
        Log::info($request);
        if ($request->file == 'undefined') {
            $validator = Validator::make($request->all(), [
                'articles_id' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'articles_id' => 'required',
                'file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
            ]);
        }

        Log::info($validator->errors());
        if ($validator->fails()) {
            return $this->error($validator->errors(), 403);
        }

        if ($request->ajax()) {
            Log::info("Store Ligne besoin Expectionel");
            Log::info($request);
            $Besoin = Besoin::where('annee_gestion',$request['annee_gestion'])->where('services_id', Auth::user()->services_id)->first();
            if(!$Besoin){
                $Besoin = Besoin::create([
                    'date_besoin' => Carbon::today()->toDateString(),
                    'services_id' => Auth::user()->services_id,
                    'annee_gestion' => $request['annee_gestion'],
                    'valider' => 1,
                ]);
            }
            $ligneBesoin = LignesBesoin::select('id', 'articles_id')
                ->where('besoins_id', $Besoin->id)
                ->where('articles_id', $request->articles_id)->first();
            Log::info("Exist Ligne besoin " . $ligneBesoin);
            if ($ligneBesoin) {
                return $this->notify('ضبط الحاجيات', 'هذه المادة موجودة سابقا ضمن الحاجيات.', 'error', true);
            }
            $article = Article::find($request->articles_id);
            $ligneBesoin = LignesBesoin::create([
                'libelle' => ($article != null) ? $article->libelle : null,
                'articles_id' => $request->articles_id,
                'description' => $request->description,
                'type_demande' => $request->type_demande,
                'nature_demandes_id' => $request->nature_demandes_id,
                'qte_demande' => $request->qte_demande,
                'cout_unite_ttc' => $request->cout_unite_ttc,
                'cout_total_ttc' => $request->qte_demande * $request->cout_unite_ttc,
                'qte_valide' => $request->qte_valide,
                'besoins_id' => $Besoin->id,
            ]);
            // ajout de document s'il existe
            if ($request->file != 'undefined') {
                if ($ligneBesoin) {
                    $request['path'] = "besoin_documents";
                    $request['besoins_id'] = $ligneBesoin->id;
                    $file = $this->fileRepository->fileUploadPost($request);
                }
            }
            //Add ligneBesoin to LigneProjet if modeprojet = editProjet
            if($request->mode =="editProjet"){
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
                            'projets_id' => $request->projets_id,
                        ]);
                        $ligneBesoin->projets_id = $request->projets_id;
                        $ligneBesoin->save();
                    }
            }

            return $this->notify('ضبط الحاجيات', '!تم إضافة مادة جديدة للحاجيات بنجاح', 'success', true);
        } else {
            return $this->notify('ضبط الحاجيات', '!خطأ داخلي الرجاء إعادة المحاولة', 'error', true);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateLigneBesoin(Request $request)
    {
        Log::info($request);
        if ($request->file == 'undefined') {
            $validator = Validator::make($request->all(), [
                'articles_id' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'articles_id' => 'required',
                'file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
            ]);
        }
        if ($validator->fails()) {
            return $this->error($validator->errors(), 403);
        }
        if (!$request->qte_valide) {
            $request->qte_valide = 0;
        }
        if ($request->ajax()) {
            $article = Article::find($request->articles_id);
            Log::info("Article Details " . $article);
            LignesBesoin::find($request->id)->update([
                'libelle' => ($article != null) ? $article->libelle : null,
                'articles_id' => $request->articles_id,
                'description' => $request->description,
                'type_demande' => $request->type_demande,
                'nature_demandes_id' => $request->nature_demandes_id,
                'qte_demande' => $request->qte_demande,
                'cout_unite_ttc' => $request->cout_unite_ttc,
                'cout_total_ttc' => $request->qte_demande * $request->cout_unite_ttc,
                'qte_valide' => $request->qte_valide,
            ]);
            if ($request->file != 'undefined') {
                $ligneBesoin = LignesBesoin::find($request->id);
                if ($ligneBesoin) {
                    $request['path'] = "besoin_documents";
                    $request['besoins_id'] = $ligneBesoin->id;
                    $file = $this->fileRepository->fileUploadPost($request);
                }
            }
            return $this->notify('ضبط الحاجيات', '!تم تحيين للحاجيات بنجاح', 'success', true);
        } else {

            return $this->notify('!  خطأ', 'خطأ عند تحيين الحاجيات', 'error');
        }

    }

    public function destroyLigneBesoin(Request $request)
    {
        LignesBesoin::find($request->id)->delete();
        /*$locale = LaravelLocalization::getCurrentLocale();
        if ($locale == 'en') {
        return $this->notify('Notification', 'ِِClient Contact deleted successfully', 'success', false);
        }
         */
        return $this->notify('ضبط الحاجيات', 'تم حذف المادة من الحاجيات بنجاح');
        // return $this->notify('حذف عميل',  session()->get('delete_error'));
    }
}
