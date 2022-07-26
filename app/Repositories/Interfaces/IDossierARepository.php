<?php
namespace App\Repositories\Interfaces;

interface IDossierARepository {
    public function getAllDossierA($annee_gestion, $services_id, $natures_demande_id, $nature_passation); // Return datatable
    public function create($request);
    public function update($request, $id);
    public function getDossierALigneDossierAByParam($key,$value);
    public function getLigneDossierAsByDossierA($DossierA_id, $mode);
    public function getDossierAByParam($key,$value);
    function transfererDossierA($projet_id, $dossier_id);
    public function destroy($id);
    public function multiDestroy($ids);
}
