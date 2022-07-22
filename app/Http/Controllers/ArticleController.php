<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Log;
use Validator;
use App\Traits\ApiResponser;

class ArticleController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'libelle'=>$request->libelle,
            'natures_demande_id'=>$request->natures_demande_id,
            'valider'=> false,
         ]);
        return $this->notify('ضبط الحاجيات', 'تم إضافة مادة جديدة  في انتظار التأكيد من المشرف على المنظومة');

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
        //
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
    public function getAllArticlesToSelect(Request $request)
    {
        if ($request->ajax()) {
            return ['results' =>Article::select('id','libelle as text')
                                ->where('natures_demande_id',$request->natures_demande_id)
                                ->orderBy('libelle')
                                ->get()];
        }
    }
}
