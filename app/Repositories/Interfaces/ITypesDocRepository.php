<?php
namespace App\Repositories\Interfaces;

interface ITypesDocRepository
{
    public function getAllTypesDoc(); // Return datatable
    public function create($request);
    public function update($request, $id);
    public function destroy($id);
    public function multiDestroy($ids);

}
