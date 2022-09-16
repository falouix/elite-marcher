<?php

namespace App\Repositories\Services;

use App\Models\DossiersAchat;
use App\Models\LignesDossier;
use App\Repositories\Interfaces\IDossierARepository;
use Log;

class DossierARepository implements IDossierARepository
{
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
                $dataAction = "AOS.datatable-actions";
                $query->where('type_dossier', 'AOS');
                break;
            case 'AON':
                $dataAction = "AOS.datatable-actions";
                $query->where('type_dossier', 'AON');
                break;
            case 'AOGREGRE':
                $dataAction = "AOS.datatable-actions";
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
            ->addColumn('action', $dataAction)
            ->rawColumns(['id', 'nature_passation', 'situationDA', 'source_financeL', 'nature_financeL', 'type_demandeL', 'total_ttc', 'action'])
            ->make(true);
    }
    public function getLigneDossierAsByDossierA($projet_id, $mode)
    {
        $dataAction = "projets.ligneprojet-datatable-actions";
        $query = LignesDossierA::select('*')->with('DossierA')->with('nature_demande')->where('projets_id', $projet_id);
        Log::info("mode ligne DossierA is " . $mode);
        Log::info("query result is  " . $query->get());

        return datatables()
            ->of($query)
            /* ->editColumn('created_at', function ($caseSession) {
        return $caseSession->created_at->format('Y-m-d');
        })*/
            ->addColumn('select', static function () {
                return null;
            })
            ->editColumn('description', function ($lignesDossierA) {

                return Str::words($lignesDossierA->description, 5);
            })
            ->editColumn('type_demande', function ($lignesDossierA) {
                switch ($lignesDossierA->type_demande) {
                    case 1:
                        return '<label class="badge badge-info"> مواد وخدمات </label>';
                    case 2:
                        return '<label class="badge badge-success"> أشغال </label>';

                    default:
                        return '<label class="badge badge-primary"> دراسات </label>';
                }
                return "";
            })
            ->editColumn('nature_demandes_id', function ($lignesDossierA) {
                if ($lignesDossierA->nature_demande) {
                    return $lignesDossierA->nature_demande->libelle;
                }
                return "";
            })
            /*->editColumn('qte_valide', function ($lignesDossierA) {
        return '<input type="number" data-id="'.$lignesDossierA->id.'" id="dtqte_valide" value="'.$lignesDossierA->qte_valide.'"/>';
        })
        ->editColumn('cout_total_ttc', function ($lignesDossierA) {
        return '<input type="number" data-id="'.$lignesDossierA->id.'" id="dtcout_total_ttc" value="'.$lignesDossierA->cout_total_ttc.'"/>
        ';
        })*/
            ->addColumn('valide', function ($lignesDossierA) {
                if ($lignesDossierA->DossierA) {
                    if ($lignesDossierA->DossierA->valider == true) {
                        return '<label class="badge badge-info">تمت المصادقة النهائية</label>';
                    } else {
                        return '<label class="badge badge-info"> لم تتم المصادقة النهائية </label>';
                    }
                }
                return "";
            })
            ->addColumn('valider', function ($lignesDossierA) {
                if ($lignesDossierA->DossierA) {
                    if ($lignesDossierA->DossierA->valider == true) {
                        return true;
                    } else {
                        return false;
                    }
                }
                return false;
            })
            ->addColumn('action_file', 'projets.file-actions')
            ->addColumn('action', $dataAction)
            ->rawColumns(['id', 'valide', 'type_demande', 'nature_demandes_id', 'action_file', 'action']) //'qte_valide','cout_total_ttc'
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
    public function getDossierWithRelations($id){
        return DossiersAchat::Select('*')
                                ->with('lignes_dossiers')
                                ->with('cahiers_charges')
                                ->with('dossier_docs')
                                ->with('offres')
                                ->with('service_ordres')
                                ->with('enregistrements')
                                ->with('bcs_engagements')
                                ->with('avis_dossiers')
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
    public function getTotalDossier($dossier_id){
        return LignesDossier::select('cout_total_ttc')->where('dossiers_achats_id',$dossier_id)->sum('cout_total_ttc');
    }


}
