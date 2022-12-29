<?php

namespace App\Repositories\Services;

use App\Models\{
    DossiersAchat, LignesDossier, Etablissement, AvisDossier, CahiersCharge,
    Offre, Reception, Cloture, Enregistrement, ServiceOrdre
};
use App\Repositories\Interfaces\IDossierARepository;
use App\Repositories\Interfaces\INotifRepository;
use Log;use Str;

class DossierARepository implements IDossierARepository
{
    private $settings;
    public function __construct(INotifRepository $notifRepository)
    {
        $this->notifRepository = $notifRepository;
        $this->settings = Etablissement::first();
    }

    public function getAllDossierA($annee_gestion, $situation_dossier, $type_demande, $type_dossier)
    {
        if (!($annee_gestion)) {
            $annee_gestion = strftime("%Y");
        }

        $query = DossiersAchat::select('*')
            ->where('annee_gestion', $annee_gestion);
        if ($type_demande != 'all') {
            $query->where('type_demande', $type_demande);
        }
        if ($situation_dossier != 'all') {
            $query->where('situation_dossier', $situation_dossier);
        }
        switch ($type_dossier) {
            case 'CONSULTATION':
                $dataAction = "dossiers_achats.consultations.datatable-actions";
                $query->where('type_dossier', 'CONSULTATION');
                break;
            case 'AOS':
                $dataAction = "dossiers_achats.AOS.datatable-actions";
                $query->where('type_dossier', 'AOS');
                break;
            case 'AON':
                $dataAction = "dossiers_achats.AOS.datatable-actions";
                $query->where('type_dossier', 'AON');
                break;
            case 'AOGREGRE':
                $dataAction = "dossiers_achats.AOGREGRE.datatable-actions";
                $query->where('type_dossier', 'AOGREGRE');
                break;
            case 'all': // for dashboard
                $dataAction = "dossiers_achats.all-datatable-actions";
                break;
        }
        Log::info("Result of query DossierAchats : " . $query->get());
        return datatables()
            ->of($query)
            ->addColumn('select', static function () {
                return null;
            })
            ->addColumn('type_demandeL', function ($dossier) {
                switch ($dossier->type_demande) {
                    case 1:
                        return '<label class="badge badge-info"> مواد وخدمات </label>';
                    case 2:
                        return '<label class="badge badge-success"> أشغال </label>';

                    default:
                        return '<label class="badge badge-primary"> دراسات </label>';
                }
                return "";
            })
            ->addColumn('source_financeL', function ($dossier) {
                switch ($dossier->source_finance) {
                    case '1':
                        return 'ميزانية الدولة';
                    case '2':
                        return 'قرض';
                    case '3':
                        return 'هبة';
                }
                return "";
            })
            ->addColumn('nature_financeL', function ($dossier) {
                switch ($dossier->source_finance) {
                    case '1':
                        return 'ثابتة';
                    case '2':
                        return 'قابلة للمراجعة';
                }
                return "";
            })
            ->addColumn('nature_passation', function ($dossier) {
                switch ($dossier->type_dossier) {
                    case 'CONSULTATION':
                        return '<label class="badge badge-info">استشارة عادية</label>';
                    case 'AOS':
                        return '<label class="badge badge-success"> صفقة إجراءات مبسطة </label>';
                    case 'AON':
                        return '<label class="badge badge-success"> صفقة إجراءات عادية </label>';
                    default:
                        return '<label class="badge badge-primary"> صفقة بالتفاوض المباشر </label>';
                }
                return "";
            })
            ->addColumn('situationDA', function ($dossier) {
                switch ($dossier->situation_dossier) {
                    case 1:
                        return '<label class="badge btn-primary-gradient btn-sm" style="color: white;">بصدد الإعداد</label>';
                    case 2:
                        return '<label class="badge btn-success-gradient btn-sm" style="color: white;"> في انتظار العروض </label>';
                    case 3:
                        return '<label class="badge btn-secondary-gradient btn-sm" style="color: white;"> في الفرز </label>';
                    case 4:
                        return '<label class="badge btn-danger-gradient btn-sm" style="color: white;"> بصدد الإنجاز </label>';
                    case 5:
                        return '<label class="badge btn-warning-gradient btn-sm" style="color: white;"> القبول الوقتي</label>';
                    case 6:
                        return '<label class="badge badge-primary" style="color: white;">القبول النهائي</label>';
                    case 7:
                        return '<label class="badge badge-secondary" style="color: white;">ملف منتهي </label>';
                    case 8:
                        return '<label class="badge btn-dark-gradient btn-sm" style="color: white;">ملغى</label>';
                }
                return "";
            })
            ->addColumn('total_ttc', function ($dossier) {
                return self::getTotalDossier($dossier->id);
            })
            ->addColumn('dashboard_action', 'dossiers_achats.dhasboard-actions')
            ->addColumn('action', $dataAction)
            ->rawColumns(['id', 'nature_passation', 'situationDA',
                'source_financeL', 'nature_financeL',
                'type_demandeL', 'total_ttc', 'dashboard_action', 'action'])
            ->make(true);
    }
    public function getAllDossierACustomer($annee_gestion, $situation_dossier, $type_demande, $type_dossier, $client_id = "all")
    {
        if (!($annee_gestion)) {
            $annee_gestion = strftime("%Y");
        }

        $query = DossiersAchat::select('*')
            ->where('annee_gestion', $annee_gestion);
        if ($client_id != 'all') {
            $query->where('soumissionaire_id', $client_id);
        }
        if ($type_demande != 'all') {
            $query->where('type_demande', $type_demande);
        }
        if ($situation_dossier != 'all') {
            $query->where('situation_dossier', $situation_dossier);
        }
        switch ($type_dossier) {
            case 'CONSULTATION':
                $dataAction = "customer.consultations.datatable-actions";
                $query->where('type_dossier', 'CONSULTATION');
                break;
            case 'AOS':
                $dataAction = "customer.AOS.datatable-actions";
                $query->where('type_dossier', 'AOS');
                break;
            case 'AON':
                $dataAction = "customer.AOS.datatable-actions";
                $query->where('type_dossier', 'AON');
                break;
            case 'AOGREGRE':
                $dataAction = "customer.AOGREGRE.datatable-actions";
                $query->where('type_dossier', 'AOGREGRE');
                break;
            case 'all': // for dashboard
                $dataAction = "customer.all-datatable-actions";
                break;
        }
        Log::info("Result of query DossierAchats customer : " . $query->get());
        return datatables()
            ->of($query)
            ->addColumn('select', static function () {
                return null;
            })

            ->addColumn('situationDA', function ($dossier) {
                switch ($dossier->situation_dossier) {
                    case 1:
                        return '<label class="badge btn-primary-gradient btn-sm" style="color: white;">بصدد الإعداد</label>';
                    case 2:
                        return '<label class="badge btn-success-gradient btn-sm" style="color: white;"> في انتظار العروض </label>';
                    case 3:
                        return '<label class="badge btn-secondary-gradient btn-sm" style="color: white;"> في الفرز </label>';
                    case 4:
                        return '<label class="badge btn-danger-gradient btn-sm" style="color: white;"> بصدد الإنجاز </label>';
                    case 5:
                        return '<label class="badge btn-warning-gradient btn-sm" style="color: white;"> القبول الوقتي</label>';
                    case 6:
                        return '<label class="badge badge-primary" style="color: white;">القبول النهائي</label>';
                    case 7:
                        return '<label class="badge badge-secondary" style="color: white;">ملف منتهي </label>';
                    case 8:
                        return '<label class="badge btn-dark-gradient btn-sm" style="color: white;">ملغى</label>';
                }
                return "";
            })
            ->addColumn('total_ttc', function ($dossier) {
                return self::getTotalDossier($dossier->id);
            })
            ->addColumn('dashboard_action', 'customer.dhasboard-actions')
            ->addColumn('action', $dataAction)
            ->rawColumns(['id', 'situationDA', 'total_ttc', 'dashboard_action', 'action'])
            ->make(true);
    }
    public function getLigneDossierAsByDossierA($dossierId, $withRelations = 0)
    {
        $dataAction = "projets.ligneprojet-datatable-actions";

        $query = LignesDossier::select('*');
        if ($withRelations == 1) {
            $query->with('dossiers_achat')->with('lignes_projet');
        }
        $query->where('dossiers_achats_id', $dossierId);

        Log::info("query LigneDossier num : " . $dossierId . " result is : " . $query->get());
        return datatables()
            ->of($query)
            ->addColumn('select', static function () {
                return null;
            })
            ->editColumn('libelle', function ($lignesDossierA) {

                return Str::words($lignesDossierA->libelle, 10);
            })
            ->addColumn('action', $dataAction)
            ->rawColumns(['id', 'action'])
            ->make(true);
    }

    public function getDossierAByParam($key, $value)
    {
        return DossiersAchat::Select('*')->where($key, '=', $value)
            ->first();
    }
    public function getDossierALigneDossierAByParam($key, $value)
    {
        return DossiersAchat::Select('*')->with('lignes_dossiers')->where($key, '=', $value)
            ->first();
    }
    public function getCCDocs($idCC, $action = "file")
    {
        $query = CcDoc::select('*')
            ->where('cahiers_charges_id', $idCC);
        $dataAction = "files.cc-docs";
        if ($action = "edit") {
            $dataAction = "dossiers_achats.consultations.cc-datatable-actions";
        }
        return datatables()
            ->of($query)
            ->addColumn('select', static function () {
                return null;
            })
            ->addColumn('action', $dataAction)
            ->rawColumns(['id', 'action'])
            ->make(true);
    }
    public function getDossierWithRelations($id, $relations)
    {
        return DossiersAchat::Select('*')->with($relations)
        /*->with('lignes_dossiers')
        ->with('cahiers_charges')
        ->with('dossier_docs')
        ->with('offres')
        ->with('service_ordres')
        ->with('enregistrements')
        ->with('bcs_engagements')
        ->with('avis_dossiers')*/
            ->where('id', $id)
            ->first();
    }
    public function destroy($id)
    {
        DossiersAchat::find($id)->delete();
        // return Response()->json(['success' => 'DossierA deleted successfully.']);
    }
    public function multiDestroy($ids)
    {
        DossiersAchat::whereIn('id', $ids)->delete();
    }
    public function getTotalDossier($dossier_id)
    {
        return LignesDossier::select('cout_total_ttc')->where('dossiers_achats_id', $dossier_id)->sum('cout_total_ttc');
    }

    // مراحل الإنجاز المشتركة
    /* Cahier des charges */
    public function cahierCharges($input)
    {
        $cc = CahiersCharge::where('dossiers_achats_id', $input['dossiers_achats_id'])->first();
        if ($cc) {
            $cc = self::updateCC($input, $cc->id);
            // Générer New Notif
        } else {
            $cc = self::createCC($input);
            // Update Notif
        }
        // Générer Notif تاريخ اعتزام التنفيذ
        if ($cc($this->settings->notif_session_op == true)) {
            $dossier = self::getDossierAByParam('id', $input['dossiers_achats_id']);
            $msg = "تذكير لإضافة الإعلان الإشهاري للملف عدد [" . $dossier->code_dossier . "] بتاريخ [" . $cc->date_pub_prevu . "]";
            // Create Notification To users
            $newNotif = new Notif();
            $newNotif->type = "RAPPEL";
            $newNotif->texte = $msg;
            $newNotif->from_table = "cahiers_charges";
            $newNotif->from_table_id = $cc->id;
            $newNotif->users_id = Auth::user()->id;
            $newNotif->action = "";
            $dateavis = Carbon::createFromFormat('Y-m-d', $cc->date_pub_prevu);
            $newNotif->date_traitement = $dateavis->subDays();
            $notif = $this->notifRepository->updateNotif($newNotif);
        }
        return $cc;
    }
    private function createCC($request)
    {
        Log::alert("Create CC Request repository");
        $input = $request->all();
        $cc = CahiersCharge::create($input);
        return $cc;
    }

    private function updateCC($request, $id)
    {
        $input = $request->all();
        $cc = CahiersCharge::find($id);
        $cc->update($input);
        return $cc;
    }
    /* Fin Cahier des charges */

    /* Avis Pub */
    public function avisPub($input)
    {
        $avis = AvisDossier::where('dossiers_achats_id', $input['dossiers_achats_id'])->first();
        if ($avis) {
            $avis = self::updateAvisPub($input, $cc->id);
        } else {
            $avis = self::createAvisPub($input);
            self::updateSituationDossier($avis->dossiers_achats_id, 2);
        }
        // Générer Notif ( New if createAvisPub , Update if updateAvisPub)
        if ($avis && ($this->settings->notif_session_op == true)) {
            $dossier = self::getDossierAByParam('id', $input['dossiers_achats_id']);
            $msg = "تذكير بتاريخ فتح الظروف المتلعق بالملف عدد [" . $dossier->code_dossier . "] بتاريخ [" . $avis->date_ouverture_plis . "]";
            // Create Notification To users
            $newNotif = new Notif();
            $newNotif->type = "RAPPEL";
            $newNotif->texte = $msg;
            $newNotif->from_table = "avis_dossiers";
            $newNotif->from_table_id = $avis->id;
            $newNotif->users_id = Auth::user()->id;
            $newNotif->action = "";
            $dateavis = Carbon::createFromFormat('Y-m-d', $avis->date_ouverture_plis);
            $newNotif->date_traitement = $dateavis->subDays($this->settings->notif_duree_session_op);
            $notif = $this->notifRepository->updateNotif($newNotif);
        }
    }
    private function createAvisPub($input)
    {
        Log::alert("Create CC Request repository");
        $input = $request->all();
        $cc = AvisDossier::create($input);
        return $cc;
    }

    private function updateAvisPub($request, $id)
    {
        $input = $request->all();
        $cc = AvisDossier::find($id);
        $cc->update($input);
        return $cc;
    }
    /* Fin Avis Pub */

    /* Reception Offres مرحلة وصول العروض*/
    // Liste des offres By DossierId
    public function getOffres($iddossier)
    {
        $query = Offre::select('*')
            ->where('dossiers_achats_id', $iddossier);
        $dataAction = "";
        return datatables()
            ->of($query)
            ->addColumn('select', static function () {
                return null;
            })
            ->editColumn('source_offre', function ($dossier) {
                switch ($dossier->source_offre) {
                    case 1:
                        return 'Tuneps';
                    case 2:
                        return 'موقع المؤسسة';
                    case 3:
                        return 'مواقع أخرى';
                }
                return "";
            })
            ->addColumn('action', $dataAction)
            ->rawColumns(['id', 'source_offre', 'action'])
            ->make(true);
    }
    public function addOffre($request)
    {
        Log::alert("Create Offre Request repository");
        $input = $request->all();
        $offre = Offre::create($input);
        return $offre;
    }
    public function updateOffre($request, $id)
    {
        Log::alert("Create Offre Request repository");
        $input = $request->all();
        $offre = Offre::find($id)->update($input);
        return $offre;
    }
    public function deleteOffre($id)
    {
        Log::alert("Delete Offre Request repository");
        Offre::find($id)->delete();
    }
    /* Fin Reception Offres */

    /* Enregistrement مرحلةتسجيل الصفقة*/
    public function createOrUpdateEnregistrement($request)
    {
        $input = $request->all();
        $enreg = Enregistrment::updateOrCreate(
            ['id' => $input->id],
            [
                'date_signature' => $input->date_signature,
                'date_enregistrement' => $input->date_enregistrement,
                'date_copie_unique' => $input->date_copie_unique,
                'ref_copie_unique' => $input->ref_copie_unique,
                'type_enregistrement' => $input->type_enregistrement,
                'dossiers_achats_id' => $input->dossiers_achats_id,
                'soumissionnaires_id' => $input->soumissionnaires_id,
            ]
        );
        return $enreg;
    }
    public function deleteEnregistrement($id)
    {
        $enreg = Enregistrement::find($id);
        if ($enreg) {
            $situationDossier = selft::getSituationDossierById($enreg->dossiers_achats_id);
            if ($situationDossier!= null && ($situationDossier <= 3) ) {
                $enreg->delete();
                return true;
            }
            return false;
        }
        return false;
    }
    /* Fin Enregistrement */

    /* Ordre de Service مرحلة إذن بداية الأشغال*/
    public function createOrUpdateOrdreService($request)
    {
        $input = $request->all();
        $enreg = ServiceOrdre::updateOrCreate(
            ['id' => $input->id],
            [
                'date_ordre' => $input->date_ordre,
                'date_reception_ordre' => $input->date_reception_ordre,
                'ref_ordre' => $input->ref_ordre,
                'ref_copie_unique' => $input->ref_copie_unique,
                'dossiers_achats_id' => $input->dossiers_achats_id,
                'soumissionnaires_id' => $input->soumissionnaires_id,
            ]
        );
        return $enreg;
    }
    public function deleteOrdreService($id)
    {
        $enreg = ServiceOrdre::find($id);
        if ($enreg) {
            $situationDossier = selft::getSituationDossierById($enreg->dossiers_achats_id);
            if ($situationDossier!= null && ($situationDossier <= 4) ) {
                $enreg->delete();
                return true;
            }
            return false;
        }
        return false;
    }
    /* Fin Ordre de Service */

    /* Reception مرحلة القبول الوقتي أو النهائي */
    public function createOrUpdateReception($request)
    {
        $input = $request->all();
        $enreg = Reception::updateOrCreate(
            ['id' => $input->id],
            [
                'date_reception' => $input->date_reception,
                'type_reception' => $input->type_reception,
                'duree_retard' => $input->duree_retard,
                'taux_avancement' => $input->taux_avancement,
                'dossiers_achats_id' => $input->dossiers_achats_id,
                'soumissionnaires_id' => $input->soumissionnaires_id,
            ]
        );
        return $enreg;
    }
    public function deleteReception($id)
    {
        $enreg = Reception::find($id);
        if ($enreg) {
            $situationDossier = selft::getSituationDossierById($enreg->dossiers_achats_id);
            if ($situationDossier!= null && ($situationDossier <= 5) ) {
                $enreg->delete();
                return true;
            }
            return false;
        }
        return false;
    }
    /* Fin Reception */

    /* Cloture مرحلة التسوية النهائية */
    public function createOrUpdateCloture($request)
    {
        $input = $request->all();
        $enreg = Cloture::updateOrCreate(
            ['id' => $input->id],
            [
                'date_reception' => $input->date_reception,
                'type_reception' => $input->type_reception,
                'duree_retard' => $input->duree_retard,
                'taux_avancement' => $input->taux_avancement,
                'dossiers_achats_id' => $input->dossiers_achats_id,
                'soumissionnaires_id' => $input->soumissionnaires_id,
            ]
        );
        return $enreg;
    }
    public function deleteCloture($id)
    {
        $enreg = Cloture::find($id);
        if ($enreg) {
            $situationDossier = selft::getSituationDossierById($enreg->dossiers_achats_id);
            if ($situationDossier!= null && ($situationDossier <= 6) ) {
                $enreg->delete();
                return true;
            }
            return false;
        }
        return false;
    }
    /* Fin Cloture */
    
    // Update Situation dossier : بصدد الإعداد 1\n، في انتظار العروض2\n في الفرز،3\n بصدد الإنجاز،4\n القبول الوقتي، 5\nالقبول النهائي،6\n ملف منتهي 7\n، ملغى
    public function updateSituationDossier($id, $situation_dossier): DossiersAchat
    {
        $dossier = DossiersAchat::find($id)->update([
            'situation_dossier' => $situation_dossier,
        ]);
        return $dossier;
    }

    // getSituation Dossier by Id
    private function getSituationDossierById($id)
    {
        return DossierAchat::find($id);
        if ($dossier) {
            return $dossier->situation_dossier;
        }
        return null;
    }

}
