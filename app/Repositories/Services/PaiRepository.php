<?php

namespace App\Repositories\Services;

use App\Models\NatureDemande;
use App\Repositories\Interfaces\IPaiRepository;
use DB;
use Log;

class PaiRepository implements IPaiRepository
{
    // المخطط السنوي للحاجيات
    public function getPAI($services_id, $annee_gestion, $type_demande, $nature_demande, $mode)
    {
        if ($mode != 'projets') {
            $grouped = DB::table('lignes_besoins')->join('besoins', 'besoins.id', '=', 'lignes_besoins.besoins_id')
            ->selectRaw('libelle,type_demande,nature_demandes_id,cout_unite_ttc,
            description,besoins_id,projets_id,docs_id,qte_demande,qte_valide,cout_total_ttc,
            SUM(qte_demande) AS sumqte_demande,
            SUM(qte_valide) AS sumqte_valide,
            SUM(cout_total_ttc) AS sumcout_total_ttc
        ');
        } else {
            $grouped = DB::table('lignes_besoins')->selectRaw('id,libelle,type_demande,nature_demandes_id,cout_unite_ttc,
            description,besoins_id,projets_id,docs_id,qte_demande,qte_valide,cout_total_ttc,
            SUM(qte_demande) AS sumqte_demande,
            SUM(qte_valide) AS sumqte_valide,
            SUM(cout_total_ttc) AS sumcout_total_ttc
        ');
        }

        $grouped->whereIn('besoins_id', function ($query) use ($services_id, $annee_gestion) {
                if ($services_id == 'all') {
                    $query
                        ->select('id')
                        ->from('besoins')
                        ->where('annee_gestion', $annee_gestion);
                } else {
                    $query
                        ->select('id')
                        ->from('besoins')
                        ->where('services_id', $services_id)
                        ->where('annee_gestion', $annee_gestion);
                }
            })
            ->groupByRaw('libelle');
        //->groupByRaw('nature_demandes_id')
        //->groupByRaw('type_demande');
        if ($nature_demande != 'all') {
            // if('$nature_demande == NULL')
            $grouped->where('nature_demandes_id', $nature_demande);
        }
        if ($type_demande != 'all') {
            $grouped->where('type_demande', $type_demande);
        }
        $dataAction = 'besoins.pais.file-actions';
        if ($mode == 'projets') {
            $grouped->where('projets_id', null);
            $dataAction = 'projets.lignes_projets.ligneprojet-datatable-actions';
        }
        if ($mode == 'editProjet') {
            $grouped->where('projets_id', null);
            $dataAction = 'projets.lignes_projets.editProjet-datatable-actions';
        }
        //->get();
        Log::alert('Pai grouped query');
        Log::info($grouped->get());

        return datatables()
            ->of($grouped)

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
                return '';
            })
            ->editColumn('nature_demandes_id', function ($lignesBesoin) {
                $naturedemande = NatureDemande::select('id', 'libelle')
                    ->where('id', $lignesBesoin->nature_demandes_id)
                    ->first();
                if ($naturedemande) {
                    return $naturedemande->libelle;
                }
                return '';
            })

            ->addColumn('action', $dataAction)
            ->rawColumns(['id', 'type_demande', 'nature_demandes_id', 'action'])
            ->make(true);
    }
    // المخطط السنوي للشراءات
    public function getPAIProjets($services_id, $annee_gestion, $type_demande, $nature_demande)
    {
        $dataAction = 'besoins.pais.file-actions';

        $grouped = DB::table('lignes_projets')
            ->join('lignes_besoins', 'lignes_besoins.id', '=', 'lignes_projets.lignes_besoin_id')
            ->join('projets', 'projets.id', '=', 'lignes_projets.projets_id')
            ->selectRaw(
                'lignes_projets.libelle,
                        lignes_projets.cout_unite_ttc,
                        lignes_besoins.nature_demandes_id,
                        lignes_besoins.type_demande,
                        lignes_besoins.docs_id,
                        SUM(qte) AS sumqte,
                        SUM(lignes_besoins.qte_demande) AS sumqte_dem,
                        SUM(lignes_projets.cout_total_ttc) AS sumcout_total_ttc
        ',
            )
            ->whereIn('projets.id', function ($query) use ($services_id, $annee_gestion) {
                if ($services_id == 'all') {
                    $query
                        ->select('id')
                        ->from('projets')
                        ->where('annee_gestion', $annee_gestion);
                } else {
                    $query
                        ->select('id')
                        ->from('projets')
                        ->where('services_id', $services_id)
                        ->where('annee_gestion', $annee_gestion);
                }
            })
            ->groupByRaw('lignes_projets.libelle')
            ->groupByRaw('lignes_besoins.nature_demandes_id')
            ->groupByRaw('lignes_besoins.type_demande');
        if ($nature_demande != 'all') {
            // if('$nature_demande == NULL')
            $grouped->where('lignes_besoins.nature_demandes_id', $nature_demande);
        }
        if ($type_demande != 'all') {
            $grouped->where('lignes_besoins.type_demande', $type_demande);
        }

        //->get();
        Log::alert('Pai Prjet grouped query');
        Log::info($grouped->get());

        return datatables()
            ->of($grouped)

            ->addColumn('select', static function () {
                return null;
            })
            ->editColumn('type_demande', function ($ligneProjet) {
                switch ($ligneProjet->type_demande) {
                    case 1:
                        return '<label class="badge badge-info"> مواد وخدمات </label>';
                    case 2:
                        return '<label class="badge badge-success"> أشغال </label>';

                    default:
                        return '<label class="badge badge-primary"> دراسات </label>';
                }
                return '';
            })
            ->editColumn('nature_demandes_id', function ($ligneProjet) {
                $naturedemande = NatureDemande::select('id', 'libelle')
                    ->where('id', $ligneProjet->nature_demandes_id)
                    ->first();
                if ($naturedemande) {
                    return $naturedemande->libelle;
                }
                return '';
            })

            ->addColumn('action', $dataAction)
            ->rawColumns(['type_demande', 'nature_demandes_id', 'action'])
            ->make(true);
    }
}
