<?php
namespace App\Repositories\Interfaces;

interface IParamBesoinsRepository
{
    public function getAllBesoinsParam(); // Return datatable
    public function create($request);
    public function update($request, $id);
    public function destroy($id);

}
