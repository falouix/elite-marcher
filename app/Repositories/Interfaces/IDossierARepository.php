<?php
namespace App\Repositories\Interfaces;

interface IDossierARepository {
    public function getAllDossierA($annee_gestion, $situation_dossier,$type_demande, $type_dossier); // Return datatable
    public function getDossierALigneDossierAByParam($key,$value);
    public function getLigneDossierAsByDossierA($DossierA_id, $mode);
    public function getDossierAByParam($key,$value);
    public function getDossierWithRelations($id);
    public function destroy($id);
    public function multiDestroy($ids);
}
