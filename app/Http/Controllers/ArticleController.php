<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Repositories\Interfaces\IArticleRepository;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Log;
use Validator;

class ArticleController extends Controller
{
    use ApiResponser;
    public function __construct(IArticleRepository $repository)
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
        return view('articles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeFromBesoin(Request $request)
    {
        Log::alert("Article store from besoin request");
        Log::info($request);
        $validator = Validator::make($request->all(), [
            'libelle' => 'required|unique:articles,libelle',
            'natures_demande_id' => 'required',
        ]);

        if ($validator->fails()) {
            Log::critical($validator->errors());
            return $this->error($validator->errors(), 403);
        }
        Article::create([
            'libelle' => $request->libelle,
            'natures_demande_id' => $request->natures_demande_id,
            'valider' => false,
        ]);
        return $this->notify('ضبط الحاجيات', 'تم إضافة مادة جديدة  في انتظار التأكيد من المشرف على المنظومة');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::alert("Article store request");
        Log::info($request);
        $validator = Validator::make($request->all(), [
            'libelle' => 'required|unique:articles,libelle',
            'natures_demande_id' => 'required',
        ]);

        if ($validator->fails()) {
            Log::critical($validator->errors());
            return $this->error($validator->errors(), 403);
        }
        Article::create([
            'libelle' => $request->libelle,
            'natures_demande_id' => $request->natures_demande_id,
            'valider' => true,
        ]);
        return $this->notify('المواد أو الطلبات', 'تم إضافة مادة جديدة بنجاح');

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
     * @param  \App\Models\Court  $Court
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request, $id)
    {
        Log::info("Article edit id ===> " . $id);
        if ($request->ajax()) {
            $article = Article::find($id);
            return response()->json($article);
        }
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
        $validator = Validator::make($request->all(), [
            'libelle' => 'required|unique:articles,libelle' . $id,
            'natures_demande_id' => 'required',
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

    public function destroy($id)
    {
        $this->repository->destroy($id);
        if (session()->has('delete_error')) {

            return $this->notify('خطأ عند الحذف ', 'لا يمكن حذف مادة لها تسجيلات مرتبطة','error');
        }
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
