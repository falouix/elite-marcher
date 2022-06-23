<?php

namespace App\Repositories\Services;

use App\Models\LignesBesoin;
use App\Models\NatureDemande;
use App\Repositories\Interfaces\IPaiRepository;
use carbon\Carbon;
use Log;
use DB;
use Str;

class PaiRepository implements IPaiRepository
{

    public function getPAI($services_id, $annee_gestion, $type_demande, $nature_demande, $mode)
    {

        $dataAction = "besoins.pais.file-actions";
        if($mode ='paiprojets'){
            $dataAction = "Projets_approvisionnement.datatable-actions";
        }

       /* $services_id = 2;
        $annee_gestion = '2022';
        $nature_demande = 2;
        $type_demande =3;
        */

        $grouped = DB::table('lignes_besoins')
        ->selectRaw('*,
            SUM(qte_demande) AS sumqte_demande,
            SUM(qte_valide) AS sumqte_valide,
            SUM(cout_total_ttc) AS sumcout_total_ttc
        ')
        ->whereIn('besoins_id',function($query) use($services_id, $annee_gestion) {
            if($services_id =='all'){
                $query->select('id')->from('besoins')
                ->where('annee_gestion', $annee_gestion);
            }else{

                $query->select('id')->from('besoins')
                ->where('services_id', $services_id)
                ->where('annee_gestion', $annee_gestion);
            }
            })
            ->groupByRaw('libelle')
            ->groupByRaw('nature_demandes_id')
            ->groupByRaw('type_demande');
        if(!$nature_demande == 'all'){
           // if('$nature_demande == NULL')
            $grouped->where('nature_demandes_id', $nature_demande);
        }
        if($type_demande != 'all'){
            $grouped->where('type_demande', $type_demande);
        }
        //->get();
        Log::alert("Pai grouped query");
        Log::info($grouped->get());


        return datatables()
            ->of($grouped)
            /* ->editColumn('created_at', function ($caseSession) {
        return $caseSession->created_at->format('Y-m-d');
        })*/
            ->addColumn('select', static function () {
                return null;
            })
            ->editColumn('type_demande', function ($lignesBesoin) {
                switch ($lignesBesoin->type_demande) {
                    case 1:
                        return '<label class="badge badge-info"> مواد وخدمات </label>';
                        case 2:
                            return '<label class="badge badge-success"> أشغال </label>';

                    default:
                    return '<label class="badge badge-primary"> دراسات </label>';
                }
                return "";
            })
            ->editColumn('nature_demandes_id', function ($lignesBesoin) {
                $naturedemande = NatureDemande::select('id','libelle')->where('id', $lignesBesoin->nature_demandes_id)->first();
                if ($naturedemande) {
                    return $naturedemande->libelle;
                }
                return "";
            })

            ->addColumn('action', $dataAction)
            ->rawColumns(['id','type_demande', 'nature_demandes_id', 'action'])
            ->make(true);
    }
}
