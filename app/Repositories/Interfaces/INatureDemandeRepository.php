<?php
namespace App\Repositories\Interfaces;

interface INatureDemandeRepository
{
    public function getAllNatureDemande(); // Return datatable
    public function getNatureDemandeSelect($type);
    public function create($request);
    public function update($request, $id);
    public function destroy($id);
    public function multiDestroy($ids);

}
