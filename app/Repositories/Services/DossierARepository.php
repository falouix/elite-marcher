<?php

namespace App\Repositories\Services;


use App\Repositories\Interfaces\IDossierARepository;
use Log;
use App\Models\{
    DossiersAchat,
    LignesDossier,
    CahiersCharge,
    AvisDossier,
};

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
    public function getLigneDossierAsByDossierA($dossierId)
    {
        $dataAction = "projets.ligneprojet-datatable-actions";
        $query = LignesDossierA::select('*')->with('dossiers_achat')->with('lignes_projet')->where('dossiers_achats_id', $dossierId);
        Log::info("query LigneDossier num : ".$dossierId." result is : " . $query->get());
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
    public function getDossierWithRelations($id)
    {
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
    public function getTotalDossier($dossier_id)
    {
        return LignesDossier::select('cout_total_ttc')->where('dossiers_achats_id', $dossier_id)->sum('cout_total_ttc');
    }

    // مراحل الإنجاز المشتركة
    /* Cahier des charges */
    public function cahierCharges($input, $dossierId){
        $cc = CahiersCharge::where('dossiers_achats_id', $dossierId)->first();
        if($cc){
            self::createCC($input);
        }
        else{
            self::updateCC($input);
        }
    }
    private function createCC($input)
    {
        Log::alert("Create CC Request repository");
        $cc = CahiersCharge::create($request);
        return $cc;
    }

    private function updateCC($input)
    {
        $input = $request->all();
        $cc = CahiersCharge::find($id);
        $cc->update($input);
        return $cc;
    }
     /* Avis Pub */
     public function avisPub($input, $dossierId){
        $cc = AvisDossier::where('dossiers_achats_id', $dossierId)->first();
        if($cc){
            self::createCC($input);
        }
        else{
            self::updateCC($input);
        }
    }
    private function createAvisPub($input)
    {
        Log::alert("Create CC Request repository");
        $cc = AvisDossier::create($request);
        return $cc;
    }

    private function updateAvisPub($input)
    {
        $input = $request->all();
        $cc = AvisDossier::find($id);
        $cc->update($input);
        return $cc;
    }


}
