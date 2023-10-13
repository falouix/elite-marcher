<?php

namespace App\Repositories\Services;

use App\Models\LignesBesoin;
use App\Models\LignesDossier;
use App\Models\LignesProjet;
use App\Models\NatureDemande;
use App\Models\Projet;
use App\Repositories\Interfaces\IPeriodesRepository;
use DB;
use Log;
use Carbon\Carbon;

class PeriodesRepository implements IPeriodesRepository
{
    public function create($request)
    {
        $Projet = Projet::create([
            'objet' => $request['objet'],
           // 'date_action_prevu' => $request['date_action_prevu'],
            'type_demande' => $request['type_demande'],
            'nature_passation' => $request['nature_passation'],
            'annee_gestion' => $request['annee_gestion'],
        ]);
        return $Projet;
    }
    public function update($request, $id)
    {
        $Projet = Projet::find($id);
        $Projet->update([
            'type_demande' => $request['type_demande'],
            'nature_passation' => $request['nature_passation'],
            'date_action_prevu' => $request['date_action_prevu'],
            'objet' => $request['objet'],
        ]);
        return $Projet;
    }
    public function updatePPM($request, $id)
    {
        $Projet = Projet::find($id);
        $Projet->update([
            'duree_travaux_prvu' => $request['duree_travaux_prvu'],
            'date_cc_prvu' => $request['date_cc_prvu'],
            'date_avis_prvu' => $request['date_avis_prvu'],
            'date_op_prvu' => $request['date_op_prvu'],
            'date_trsfert_ca_prvu' => $request['date_trsfert_ca_prvu'],
            'date_trsfert_cao_prvu' => $request['date_trsfert_cao_prvu'],
            'date_repca_prvu' => $request['date_repca_prvu'],
            'date_pub_reslt_prvu' => $request['date_pub_reslt_prvu'],
            'date_avis_soumissionaire_prvu' => $request['date_avis_soumissionaire_prvu'],
            'date_ordre_serv_prvu' => $request['date_ordre_serv_prvu'],
        ]);
        return $Projet;
    }

    public function getAllProjet($annee_gestion, $services_id, $type_demande, $nature_passation, $mode = "projet")
    {
        Log::info("projet mode : " . $mode . " / Nature Passation : " . $nature_passation);
        $dataAction = "projets.datatable-actions";
        if ($mode == "ppm") {
            $dataAction = "projets.ppm.datatable-actions";
        }
        if (!($annee_gestion)) {
            $annee_gestion = strftime("%Y");
        }
        $query = Projet::select('*')
            ->where('annee_gestion', $annee_gestion)
            ->with('service');

        if ($services_id != 'all') {
            Log::info("clause if service");
            $query->where('services_id', $services_id);
        }
        if ($type_demande != 'all') {
            Log::info("clause if type demande");
            $query->where('type_demande', $type_demande);
        }
        if ($nature_passation != 'all') {
            Log::info("clause if nature passation");
            $query->where('nature_passation', $nature_passation);
        }
        $query->orderBy('transferer');
        Log::info("Result of query projets : " . $query->get());
        return datatables()
            ->of($query)
            ->addColumn('select', static function () {
                return null;
            })
            ->addColumn('service', function ($Projet) {
                if ($Projet->service) {
                    return $Projet->service->libelle;
                }
                return null;
            })
            ->addColumn('type_demandeL', function ($projet) {
                switch ($projet->type_demande) {
                    case 1:
                        return '<label class="badge badge-info"> مواد وخدمات </label>';
                    case 2:
                        return '<label class="badge badge-success"> أشغال </label>';

                    default:
                        return '<label class="badge badge-primary"> دراسات </label>';
                }
                return "";
            })
            ->addColumn('nature_passationL', function ($projet) {
                switch ($projet->nature_passation) {
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

            ->addColumn('action', $dataAction)
            ->rawColumns(['id', 'nature_passationL', 'type_demandeL', 'service', 'action'])
            ->make(true);
    }
    public function getAllProjetToPrint($annee_gestion, $services_id, $type_demande, $nature_passation, $mode = "ppm")
    {
        Log::info("projet mode : " . $mode . " / Nature Passation : " . $nature_passation);

        if (!($annee_gestion)) {
            $annee_gestion = strftime("%Y");
        }
        $query = Projet::select('*')
            ->where('annee_gestion', $annee_gestion)
            ->with('service');

        if ($services_id != 'all') {
            Log::info("clause if service");
            $query->where('services_id', $services_id);
        }
        if ($type_demande != 'all') {
            Log::info("clause if type demande");
            $query->where('type_demande', $type_demande);
        }
        if ($nature_passation != 'all') {
            Log::info("clause if nature passation");
            $query->where('nature_passation', $nature_passation);
        }
        $query->orderBy('transferer');
        Log::info("Result of query projets : " . $query->get());

        return $query->get();
    }
    public function getLigneProjetsByProjet($projet_id, $mode)
    {
        $dataAction = 'projets.lignes_projets.ligneprojet-datatable-actions';
        $dataActionPPM = 'projets.lignes_projets.ppm-ligneprojet-datatable';
        $query = DB::table('lignes_projets')->Where('lignes_projets.deleted_at', null)->join('lignes_besoins', 'lignes_besoins.id', '=', 'lignes_projets.lignes_besoin_id')
            ->join('projets', 'projets.id', '=', 'lignes_projets.projets_id')
            ->selectRaw('lignes_projets.id,
                     lignes_projets.libelle,
                     lignes_projets.num_lot,
                     lignes_projets.cout_unite_ttc,
                     lignes_besoins.nature_demandes_id,
                     lignes_besoins.type_demande,
                     lignes_besoins.docs_id,
                     lignes_projets.qte,
                     lignes_projets.cout_total_ttc,
                     lignes_projets.lbsoins_ids,
                     lignes_projets.projets_id
                     ')
            ->where('lignes_projets.projets_id', $projet_id);

        Log::info("mode ligne Projet is " . $mode);
        Log::info("query LignesProjets result is  " . $query->get());

        return datatables()
            ->of($query)

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
                return "";
            })
            ->editColumn('nature_demandes_id', function ($ligneProjet) {

                $naturedemande = NatureDemande::select('id', 'libelle')->where('id', $ligneProjet->nature_demandes_id)->first();
                if ($naturedemande) {
                    return $naturedemande->libelle;
                }
                return "";
            })

            ->addColumn('action', $dataAction)
            ->addColumn('actionPPM', $dataActionPPM)
            ->rawColumns(['type_demande', 'nature_demandes_id', 'action', 'actionPPM'])
            ->make(true);
    }

    public function getProjetByParam($key, $value)
    {
        return Projet::Select('*')->where($key, '=', $value)
            ->get()->first();
    }
    public function getProjetLigneProjetByParam($key, $value)
    {
        return Projet::Select('*')->with('lignes_projets')->where($key, '=', $value)
            ->get()->first();
    }
    public function validerProjet($id)
    {
        Projet::find($id)->update([
            'valider' => true,
        ]);
        // return Response()->json(['success' => 'Projet deleted successfully.']);
    }

    public function transfererProjet($projet_id, $dossier_id)
    {
        $lignesProjet = LignesProjet::select('*')->where('projets_id', $projet_id)->get();
        foreach ($lignesProjet as $item) {
            Log::info('Ligne Projet ' . $item);
            LignesDossier::create([
                'num_lot' => $item->num_lot,
                'libelle' => $item->libelle,
                'lignes_projet_id' => $item->id,
                'qte' => $item->qte,
                'cout_unite_ttc' => $item->cout_unite_ttc,
                'cout_total_ttc' => $item->cout_total_ttc,
                'dossiers_achats_id' => $dossier_id,
            ]);
        }
        self::markProjetAsTransferer($projet_id);
    }

    private function markProjetAsTransferer($id)
    {
        Projet::find($id)->update([
            'transferer' => true,
        ]);
    }

    public function destroy($id)
    {
        Projet::find($id)->forceDelete();
        LignesBesoin::where('projets_id', $id)->update(['projets_id'=> null]);

    }
    public function destroyLigneProjet($id)
    {
        $lp = LignesProjet::find($id);
        if ($lp) {
            LignesBesoin::find($lp->lignes_besoin_id)->update([
                "projets_id" => null,
            ]);
        }
        $lp->delete();
    }
    public function multiDestroy($ids)
    {
        Projet::whereIn('id', $ids)->delete();
    }

}
