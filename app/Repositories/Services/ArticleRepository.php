<?php

namespace App\Repositories\Services;

use App\Models\Article;
use App\Repositories\Interfaces\IArticleRepository;
use carbon\Carbon;
use Log;

class ArticleRepository implements IArticleRepository
{
    public function create($request)
    {
        Log::alert("Create Article Request repository");
        Log::info($request['libelle']);
        // dd($request);
        //dd($request['date_Article']);
        $Article = Article::create($request);
        return $Article;
    }

    public function update($request, $id)
    {
        $input = $request->all();
        $Article = Article::find($id);
        $Article->update($input);
        return $Article;
    }

    public function getAllArticle($type)
    {
        $dataAction = "articles.datatable-actions";
            $query = Article::select('*');
            if($type){
                $query->where('natures_demande_id',$type);
            }
            $query->orderByDesc('libelle');
        return datatables()
            ->of($query)
            ->addColumn('select', static function () {
                return null;
            })
            ->addColumn('status', function ($article) {
                if ($article->valider == true) {
                    return '<label class="badge badge-success">مفعل</label>';
                } else {
                    return '<label class="badge badge-info">غير مفعل</label>';
                }
                return '<label class="badge badge-info">غير مفعل</label>';
            })
            ->addColumn('action', $dataAction)
            ->rawColumns(['id', 'status', 'action'])
            ->make(true);
    }
    public function getArticleSelect($type){
        return ['results' =>Article::select('id','libelle as text')
        ->where('natures_demande_id',$type)
        ->orderBy('libelle')
        ->get()];
    }
    public function destroy($id)
    {
        Article::find($id)->delete();
    }
    public function multiDestroy($ids){
        Article::whereIn('id', $ids)->delete();
    }

}
