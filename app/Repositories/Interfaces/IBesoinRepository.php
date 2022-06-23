<?php
namespace App\Repositories\Interfaces;

interface IBesoinRepository {
    public function getAllBesoin($services_id, $annee_gestion, $status, $mode); // Return datatable
    public function create($request);
    public function update($request, $id);
    public function getBesoinLigneBesoinByParam($key,$value);
    public function getLigneBesoinsByBesoin($besoin_id, $mode);
    public function getBesoinByParam($key,$value);
    public function validerBesoin($id);
    public function destroy($id);
    public function multiDestroy($ids);
    
}
