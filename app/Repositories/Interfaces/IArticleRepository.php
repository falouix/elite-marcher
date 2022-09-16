<?php
namespace App\Repositories\Interfaces;

interface IArticleRepository
{
    public function getAllArticle($type); // Return datatable
    public function getArticleSelect($type);
    public function create($request);
    public function update($request, $id);
    public function destroy($id);
    public function multiDestroy($ids);

}
