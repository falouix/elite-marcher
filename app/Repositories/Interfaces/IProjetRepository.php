<?php
namespace App\Repositories\Interfaces;

interface IProjetRepository {
    public function getAllProjet($annee_gestion, $services_id, $natures_demande_id, $nature_passation); // Return datatable
    public function create($request);
    public function update($request, $id);
    public function getProjetLigneProjetByParam($key,$value);
    public function getLigneProjetsByProjet($Projet_id, $mode);
    public function getProjetByParam($key,$value);
    public function destroy($id);
    public function multiDestroy($ids);
}