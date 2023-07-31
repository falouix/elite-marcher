<?php

namespace App\Http\Controllers;

use App\Models\TypesDoc;
use App\Models\Notif;
use App\Repositories\Interfaces\INotifRepository;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Log;
use Auth;
use Validator;
use Carbon\Carbon;
use App\Common\Utility;

class TypeDocController extends Controller
{
    use ApiResponser;
    private $newNotif;
    public function __construct( INotifRepository $notifRepository)
    {

        $this->notifRepository = $notifRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('types_docs.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFromBesoin(Request $request)
    {
         // Prevent XSS Attack
         Utility::stripXSS($request);
        Log::alert("Article store from besoin request");
        Log::info($request);
        $validator = Validator::make($request->all(), [
            'libelle' => 'required|unique:types_docs,libelle',
        ]);

        if ($validator->fails()) {
            Log::critical($validator->errors());
            return $this->error($validator->errors(), 403);
        }
        $article = Article::create([
            'libelle' => $request->libelle,
            'type_doc' => $request->type_doc,
        ]);
        if($article){
            $msg = "قام المستعمل [". Auth::user()->name ."] بإضافة توع وثيقة جديدة[". $article->libelle ."] ";
            // Create Notification To users
            $newNotif = new Notif();
            $newNotif->type = "RAPPEL";
            $newNotif->texte = $msg;
            $newNotif->from_table = "articles";
            $newNotif->from_table_id = $article->id;
            $newNotif->users_id = Auth::user()->id;
            $newNotif->users_id = Auth::user()->id;
            $newNotif->read_at =  Carbon::now()->format('d-m-Y');
            $newNotif->action = route('types_docs.index');
            $notif = $this->notifRepository->GenererNotif($newNotif);
        }


        return $this->notify(' إعدادات', 'تم إضافة نوع وثيقة جديدة ');
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
        Log::alert("Article store request");
        Log::info($request);
        $validator = Validator::make($request->all(), [
            'libelle' => 'required|unique:types_docs,libelle',
        ]);
        if ($validator->fails()) {
            Log::critical($validator->errors());
            return $this->error($validator->errors(), 403);
        }
        Article::create([
            'libelle' => $request->libelle,
            'type_doc' => $request->type_doc,
            'valider' => true,
        ]);
        return $this->notify('المواد أو الطلبات', 'تم إضافة مادة جديدة بنجاح');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request, $id)
    {
        Log::info("Article edit id ===> " . $id);
        if ($request->ajax()) {
            $article = TypesDoc::find($id);
            Log::info("Article edit details ===> " . $article);
            return response()->json($article);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
         // Prevent XSS Attack
         Utility::stripXSS($request);
        \Log::alert("Update Article from view ".$request);
        $validator = Validator::make($request->all(), [
            'libelle' => 'required|unique:types_docs,libelle,' . $id,
        ]);
        if ($validator->fails()) {
            return $this->error($validator->errors(), 403);
        }
        Article::find($id)->update([
            'libelle' => $request->libelle,
            'natures_demande_id' => $request->natures_demande_id,
        ]);
        return $this->notify(' المواد أو الطلبات', 'تم تحيين المادة بنجاح');
    }
    /**
     * Update the specified resource in storage. : Valider Article
     * * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */


    public function destroy($id)
    {
        $this->repository->destroy($id);
        if (session()->has('delete_error')) {
            return $this->notify('خطأ عند الحذف ', 'لا يمكن حذف مادة لها تسجيلات مرتبطة','error');
        }
        return $this->notify('حذف المواد أو الطلبات ', 'تم حذف المادة بنجاح');
    }
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllArticlesDatatable(Request $request)
    {
        Log::alert("Articles Request from view");
        Log::info($request->nature_demande);
        if ($request->ajax()) {
            return $this->repository->getAllArticle($request->nature_demande);
        }

    }
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllArticlesToSelect(Request $request)
    {
        \Log::info($request);
        if ($request->ajax()) {
            return $this->repository->getArticleSelect($request->natures_demande_id);
        }
    }
}
