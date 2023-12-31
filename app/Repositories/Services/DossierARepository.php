<?php

namespace App\Repositories\Services;

use App\Models\Annulation;
use App\Models\AvisDossier;
use App\Models\CahiersCharge;
use App\Models\Cloture;
use App\Models\DossiersAchat;
use App\Models\Enregistrement;
use App\Models\Etablissement;
use App\Models\LignesDossier;
use App\Models\Offre;
use App\Models\Notif;
use App\Models\Reception;
use App\Models\ServiceOrdre;
use App\Repositories\Interfaces\IDossierARepository;
use App\Repositories\Interfaces\INotifRepository;
use Log;use Str;use Auth;
use Carbon\Carbon;

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
        if ($cc && ($this->settings->notif_avis_pub == true)) {
            $dossier = self::getDossierAByParam('id', $input['dossiers_achats_id']);
            $msg = "تذكير لإضافة الإعلان الإشهاري للملف عدد [" . $dossier->code_dossier . "] بتاريخ [" . $cc->date_pub_prevu . "]";
            // Create Notification To users
            $newNotif = new Notif();
            $newNotif->type = "RAPPEL";
            $newNotif->texte = $msg;
            $newNotif->from_table = "cahiers_charges";
            $newNotif->from_table_id = $cc->id;
            $newNotif->users_id = Auth::user()->id;
            $newNotif->action = route('consultations.edit', ecnrypt($dossier->id));
            $newNotif->read_at = Carbon::parse($cc->date_pub_prevu)->subDays($this->settings->notif_duree_pub)->format('Y-m-d');
            Log::info("read_at : ".$newNotif->read_at);
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
        Log::info('avis pub add or update from repository');
        $avis = AvisDossier::where('dossiers_achats_id', $input['dossiers_achats_id'])->first();
        if ($avis) {
            $avis = self::updateAvisPub($input, $avis->id);
        } else {
            $avis = self::createAvisPub($input);
            self::updateSituationDossier($avis->dossiers_achats_id, 2);
        }
        $dossier = self::getDossierAByParam('id', $input['dossiers_achats_id']);
        // Générer Notif ( New if createAvisPub , Update if updateAvisPub)
        if ($avis && ($this->settings->notif_session_op == true)) {
            // Notif OP
            $msg = "تذكير بتاريخ فتح الظروف المتلعق بالملف عدد [" . $dossier->code_dossier . "] بتاريخ [" . $avis->date_ouverture_plis . "]";
            $newNotif = new Notif();
            $newNotif->type = "RAPPEL";
            $newNotif->texte = $msg;
            $newNotif->from_table = "avis_dossiers";
            $newNotif->from_table_id = $avis->id;
            $newNotif->users_id = Auth::user()->id;
            $newNotif->action = "";
            $newNotif->read_at = Carbon::parse( $avis->date_ouverture_plis)->subDays($this->settings->notif_duree_session_op)->format('Y-m-d');
            Log::info("OUVERTURE DES PLIS read_at : ".$newNotif->read_at);
            $this->notifRepository->updateNotif($newNotif);
        }
        if ($avis && ($this->settings->notif_caution_provisoire == true)) {
            $cc = CahiersCharge::where('dossiers_achats_id', $input['dossiers_achats_id'])->first();
            // Notif CautionProvisoire
            $newNotif = new Notif();
            $newNotif->type = "RAPPEL";
            $newNotif->texte = $msg;
            $newNotif->from_table = "avis_dossiers";
            $newNotif->from_table_id = $avis->id;
            $newNotif->users_id = Auth::user()->id;
            $newNotif->action = "";

            $newNotif->read_at = Carbon::parse($avis->date_validite)->addDays($cc->duree_caution_prov +1)->format('Y-m-d');
            $msg = "تذكير بحلول آجال الضمان الوقتي المتلعق بالملف عدد [" . $dossier->code_dossier . "] بتاريخ [" . $newNotif->read_at . "]";

            $newNotif->read_at = Carbon::parse($newNotif->read_at)->subDays($this->settings->notif_duree_caution_provisoire)->format('Y-m-d');
            Log::info("CAUTION PROVISOIRE read_at : ".$newNotif->read_at);
            $this->notifRepository->updateNotif($newNotif);
        }
    }
    private function createAvisPub($request)
    {
        $input = $request->all();
        Log::info("request create avis pub repository : ");
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
    /*****   عدد الملفات المسحوبة */
    public function getCountOffres($id)
    {
        $count_offres = DB::table('offres')
        // ->select( DB::raw('count(ref_offre) as countOffre') )
            ->where('dossiers_achats_id', 12)
            ->count();
        // get date_validite from avis
        $avis = AvisDossier::select('date_validite')->where('dossiers_achats_id', 12)->first();
        if ($avis) {

            $count_offresDansDelais = DB::table('offres')
            // ->select( DB::raw('count(ref_offre) as countOffre') )
                ->where('dossiers_achats_id', 12)
                ->where('date_arrive', '<=', $avis->date_validite)
                ->count();
            $count_offreHorsDelais = $count_offres - $count_offresDansDelais;
            $arrayCountOffres = [
                "count_offres" => $count_offres,
                "count_offresDansDelais" => $count_offresDansDelais,
                "count_offreHorsDelais" => $count_offreHorsDelais,
            ];
            return $arrayCountOffres;
        }
        return $arrayCountOffres = [
            "count_offres" => $count_offres,
            "count_offresDansDelais" => $count_offres,
            "count_offreHorsDelais" => 0,
        ];
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
        self::updateSituationDossier($enreg->dossiers_achats_id, 3);
        return $enreg;
    }
    public function deleteEnregistrement($id)
    {
        $enreg = Enregistrement::find($id);
        if ($enreg) {
            $situationDossier = selft::getSituationDossierById($enreg->dossiers_achats_id);
            if ($situationDossier != null && ($situationDossier <= 3)) {
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
                'dossiers_achats_id' => $input->dossiers_achats_id,
                'soumissionnaires_id' => $input->soumissionnaires_id,
            ]
        );
        self::updateSituationDossier($enreg->dossiers_achats_id, 4);
        // Notif Reception Provisoire
         $newNotif = new Notif();
         $newNotif->type = "RAPPEL";
         $newNotif->from_table = "ServiceOrdre";
         $newNotif->from_table_id = $enreg->id;
         $newNotif->users_id = Auth::user()->id;
         $newNotif->action = "";

         $newNotif->read_at = Carbon::parse($enreg->date_ordre)->addDays($cc->duree_travaux)->format('Y-m-d');
         $msg = "تذكير بحلول آجال القبول الوقتي للأشغال المتلعق بالملف عدد [" . $enreg->dossiers_achats_id . "] بتاريخ [" . $newNotif->read_at . "]";
         $newNotif->texte = $msg;
         $newNotif->read_at = Carbon::parse($newNotif->read_at)->subDays($this->settings->notif_duree_caution_provisoire)->format('Y-m-d');
         Log::info("RECEPTION PROVISOIRE read_at : ".$newNotif->read_at);
         $this->notifRepository->updateNotif($newNotif);
        return $enreg;
    }
    public function deleteOrdreService($id)
    {
        $enreg = ServiceOrdre::find($id);
        if ($enreg) {
            $situationDossier = selft::getSituationDossierById($enreg->dossiers_achats_id);
            if ($situationDossier != null && ($situationDossier <= 4)) {
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
                'dossiers_achats_id' => $input->dossiers_achats_id,
            ]
        );
        //situation dossier
        if($input->type_reception == '1'){
            self::updateSituationDossier($enreg->dossiers_achats_id, 5);
        }else{
            // Type : Reception definitive
            self::updateSituationDossier($enreg->dossiers_achats_id, 6);
            // Notif Caution Definitif
            if ($this->settings->notif_date_caution_final == true) {
                $cc = CahiersCharge::where('dossiers_achats_id', $enreg->dossiers_achats_id)->first();
                // Notif CautionDefinitif
                // Méthode de calcul à voir avec UJ
                $newNotif = new Notif();
                $newNotif->type = "RAPPEL";
                $newNotif->texte = $msg;
                $newNotif->from_table = "receptions";
                $newNotif->from_table_id = $enreg->id;
                $newNotif->users_id = Auth::user()->id;
                $newNotif->action = "";
                $newNotif->read_at = Carbon::parse($cc->date_validite)->addDays($cc->duree_caution_prov +1)->format('Y-m-d');
                $msg = "تذكير بحلول آجال الضمان الوقتي المتلعق بالملف عدد [" . $dossier->code_dossier . "] بتاريخ [" . $newNotif->read_at . "]";

                $newNotif->read_at = Carbon::parse($newNotif->read_at)->subDays($this->settings->notif_duree_caution_provisoire)->format('Y-m-d');
                Log::info("CAUTION PROVISOIRE read_at : ".$newNotif->read_at);
                $this->notifRepository->updateNotif($newNotif);
            }

        }

        return $enreg;
    }
    public function deleteReception($id)
    {
        $enreg = Reception::find($id);
        if ($enreg) {
            $situationDossier = selft::getSituationDossierById($enreg->dossiers_achats_id);
            if ($situationDossier != null && ($situationDossier <= 5)) {
                $enreg->delete();
                return true;
            }
            return false;
        }
        return false;
    }
    /* Fin Reception */
    /* Annulation مرحلة إلغاء صفقة */
    public function createOrUpdateAnnulation($request)
    {
        $input = $request->all();
        $enreg = Annulation::updateOrCreate(
            ['id' => $input->id],
            [
                'date_annul' => $input->date_annul,
                'date_decision' => $input->date_decision,
                'dossiers_achats_id' => $input->dossiers_achats_id,
                'soumissionnaires_id' => $input->soumissionnaires_id,
            ]
        );
        self::updateSituationDossier($input->dossiers_achats_id, 8);
        return $enreg;
    }
    public function deleteAnnulation($id)
    {
        $enreg = Annulation::find($id);
        if ($enreg) {
            //$situationDossier = selft::getSituationDossierById($enreg->dossiers_achats_id);
            // if ($situationDossier!= null && ($situationDossier <= 6) ) {
            $enreg->delete();
            return true;
            // }
            //  return false;
        }
        return false;
    }
    /* Fin Annulation */

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
        self::updateSituationDossier($input->dossiers_achats_id, 7);
        return $enreg;
    }
    public function deleteCloture($id)
    {
        $enreg = Cloture::find($id);
        if ($enreg) {
            $situationDossier = selft::getSituationDossierById($enreg->dossiers_achats_id);
            if ($situationDossier != null && ($situationDossier <= 6)) {
                $enreg->delete();
                return true;
            }
            return false;
        }
        return false;
    }
    /* Fin Cloture */

    // Update Situation dossier : بصدد الإعداد 1\n، في انتظار العروض2\n في الفرز،3\n بصدد الإنجاز،4\n القبول الوقتي، 5\nالقبول النهائي،6\n ملف منتهي 7\n، ملغى
    public function updateSituationDossier($id, $situation_dossier)
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
