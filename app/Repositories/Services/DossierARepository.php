<?php

namespace App\Repositories\Services;

use App\Repositories\Interfaces\IDossierARepository;
use App\Models\DossiersAchat;
use App\Models\Projet;
use App\Models\LignesDossier;
use Log;

class DossierARepository implements IDossierARepository
{
    public function create($request)
    {
        // dd($request);
        //dd($request['date_projet']);
        $Projet = Projet::create([
           // 'date_projet' => $request['date_projet'],
            'objet' => $request['objet'],
            'date_action_prevu' => $request['date_action_prevu'],
            'type_demande' => $request['type_demande'],
            'nature_passation' => $request['nature_passation'],
            'services_id' => $request['services_id'],
            'annee_gestion' => $request['annee_gestion'],
        ]);
        return $Projet;
    }
    public function update($request, $id)
    {
        $input = $request->all();

        $Projet = Projet::find($id);
        $Projet->update($input);
        return $Projet;
    }

    public function getAllProjet($annee_gestion, $services_id, $type_demande, $nature_passation)
    {
        $dataAction = "projets.datatable-actions";
        if (!($annee_gestion)) {
            $annee_gestion = strftime("%Y") ;
        }
        $query = Projet::select('*')
                        ->where('annee_gestion', $annee_gestion)
                        ->with('service');
        if ($services_id != 'all'){
            $query->where('services_id', $services_id);
        }
        if ($type_demande != 'all'){
            $query->where('type_demande', $type_demande);
        }
        if ($nature_passation != 'all'){
            $query->where('nature_passation', $nature_passation);
        }
        $query->orderBy('transferer');
        Log::info("Result of query projets : ". $query->get());
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
    public function getLigneProjetsByProjet($projet_id, $mode)
    {
        $dataAction = "projets.ligneprojet-datatable-actions";
         $query = LignesProjet::select('*')->with('Projet')->with('nature_demande')->where('projets_id', $projet_id);
        Log::info("mode ligne Projet is ".$mode);
        Log::info("query result is  ".$query->get());

        return datatables()
            ->of($query)
            /* ->editColumn('created_at', function ($caseSession) {
        return $caseSession->created_at->format('Y-m-d');
        })*/
            ->addColumn('select', static function () {
                return null;
            })
            ->editColumn('description', function ($lignesProjet) {

                return Str::words($lignesProjet->description,5);
            })
            ->editColumn('type_demande', function ($lignesProjet) {
                switch ($lignesProjet->type_demande) {
                    case 1:
                        return '<label class="badge badge-info"> مواد وخدمات </label>';
                        case 2:
                            return '<label class="badge badge-success"> أشغال </label>';

                    default:
                    return '<label class="badge badge-primary"> دراسات </label>';
                }
                return "";
            })
            ->editColumn('nature_demandes_id', function ($lignesProjet) {
                if ($lignesProjet->nature_demande) {
                    return $lignesProjet->nature_demande->libelle;
                }
                return "";
            })
            /*->editColumn('qte_valide', function ($lignesProjet) {
                return '<input type="number" data-id="'.$lignesProjet->id.'" id="dtqte_valide" value="'.$lignesProjet->qte_valide.'"/>';
            })
            ->editColumn('cout_total_ttc', function ($lignesProjet) {
                return '<input type="number" data-id="'.$lignesProjet->id.'" id="dtcout_total_ttc" value="'.$lignesProjet->cout_total_ttc.'"/>
                ';
            })*/
            ->addColumn('valide', function ($lignesProjet) {
                if ($lignesProjet->Projet) {
                    if($lignesProjet->Projet->valider == true){
                        return '<label class="badge badge-info">تمت المصادقة النهائية</label>';
                    }else{
                        return '<label class="badge badge-info"> لم تتم المصادقة النهائية </label>';
                    }
                }
                return "";
            })
            ->addColumn('valider', function ($lignesProjet) {
                if ($lignesProjet->Projet) {
                    if($lignesProjet->Projet->valider == true){
                        return true;
                    }else{
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

    public function getProjetByParam($key,$value){
        return Projet::Select('*')->where($key, '=', $value)
                                 ->get()->first();
    }
    public function getProjetLigneProjetByParam($key,$value){
        return Projet::Select('*')->with('lignes_projets')->where($key, '=', $value)
                                 ->get()->first();
    }
    public function validerProjet($id)
    {
        Projet::find($id)->update([
            'valider'=>true,
        ]);
       // return Response()->json(['success' => 'Projet deleted successfully.']);
    }
    public function markProjetAsTransferer($id)
    {
        Projet::find($id)->update([
            'transferer'=>true,
        ]);
       // return Response()->json(['success' => 'Projet deleted successfully.']);
    }
    public function transfererProjet($projet_id, $dossier_id)
    {
        $lignesProjet = LignesProjet::select('*')->where('projets_id', $projet_id)->get();
        foreach ($lignesProjet as $item) {
            LignesDossier::create([
                'num_lot'=> $item->num_lot,
                'libelle'=> $item->libelle,
                'articles_id'=> $item->articles_id,
                'qte'=> $item->qte,
                'cout_unite_ttc'=> $item->cout_unite_ttc,
                'cout_total_ttc'=> $item->cout_total_ttc,
                'dossiers_achats_id'=> $dossier_id,
            ]);
        }
        markProjetAsTransferer($projet_id);
       // return Response()->json(['success' => 'Projet deleted successfully.']);
    }
    public function destroy($id)
    {
        Projet::find($id)->delete();
       // return Response()->json(['success' => 'Projet deleted successfully.']);
    }
    public function multiDestroy($ids){
        Projet::whereIn('id', $ids)->delete();
    }

}
