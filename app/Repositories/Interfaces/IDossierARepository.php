<?php
namespace App\Repositories\Interfaces;

interface IDossierARepository
{
    public function getAllDossierA($annee_gestion, $situation_dossier, $type_demande, $type_dossier); // Return datatable
    public function getAllDossierACustomer($annee_gestion, $situation_dossier, $type_demande, $type_dossier, $client_id = "all"); // Return datatable
    public function getDossierALigneDossierAByParam($key, $value);
    public function getLigneDossierAsByDossierA($dossierId, $withRelations = 0);
    public function getDossierAByParam($key, $value);

    public function getCCDocs($idCC, $action = "file");
    public function getDossierWithRelations($id, $relations);
    public function updateSituationDossier($id, $situation_dossier);
    public function destroy($id);
    public function multiDestroy($ids);
    // مراحل الإنجاز المشتركة
    /* كراس الشروط*/
    public function cahierCharges($input);
    /* الإعلان الإشهاري*/
    public function avisPub($input);
    /* وصول العروض */
    public function getOffres($iddossier);
    public function addOffre($request);
    public function updateOffre($request, $id);
    public function deleteOffre($id);
    /* Enregistrement */
    public function createOrUpdateEnregistrement($request);
    public function deleteEnregistrement($id);
    /* Ordre de Service مرحلة إذن بداية الأشغال*/
    public function createOrUpdateOrdreService($request);
    public function deleteReception($id);
    /* Cloture مرحلة التسوية النهائية */
    public function createOrUpdateCloture($request);
    public function deleteCloture($id);
    /* Annulation مرحلة إلغاء صفقة  */
    public function createOrUpdateAnnulation($request);
    public function deleteAnnulation($id);
}
