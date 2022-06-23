<?php

namespace App\Repositories\Services;

use App\Models\Besoin;
use App\Models\LignesBesoin;
use App\Repositories\Interfaces\IBesoinRepository;
use carbon\Carbon;
use Log;
use Str;

class BesoinRepository implements IBesoinRepository
{
    public function create($request)
    {
        // dd($request);
        //dd($request['date_besoin']);
        $besoin = Besoin::create([
            'date_besoin' => $request['date_besoin'],
            'services_id' => $request['services_id'],
            'annee_gestion' => $request['annee_gestion'],
            'valider' => 0,
        ]);
        return $besoin;
    }
    public function update($request, $id)
    {
        $input = $request->all();

        $Besoin = Besoin::find($id);
        $Besoin->update($input);
        return $Besoin;
    }

    public function getAllBesoin($services_id, $annee_gestion, $status , $mode)
    {
        $dataAction = "besoins.datatable-actions";
        if($mode =="validation"){
            $dataAction = "besoins.validation.datatable-actions";
        }
        if (!($annee_gestion)) {
            $annee_gestion = strftime("%Y") ;
        }
        if ($services_id != 'all') {
            if($status == 'all'){
                $query = Besoin::select('*')
                // ->with('lignes_besoins')
                    ->with('service')
                    ->where('services_id', $services_id)
                    ->where('annee_gestion', $annee_gestion)
                    ->orderByDesc('id');
                    Log::info('status is : '. $status);

            }else{
                $query = Besoin::select('*')
            // ->with('lignes_besoins')
                ->with('service')
                ->where('services_id', $services_id)
                ->where('valider', $status)
                ->where('annee_gestion', $annee_gestion)
                ->orderByDesc('id');

            }


        } else {
            if($status == 'all'){
            $query = Besoin::select('*')
            // ->with('lignes_besoins')
                ->with('service')
                //->where('valider', $status)
                ->where('annee_gestion', $annee_gestion)
                ->orderByDesc('id');
                Log::info("144444");
            }else{

                $query = Besoin::select('*')
                // ->with('lignes_besoins')
                    ->with('service')
                    ->where('valider', $status)
                    ->where('annee_gestion', $annee_gestion)
                    ->orderByDesc('id');
                    Log::info("15555555");
            }
        }
        Log::alert("query besoins");


        return datatables()
            ->of($query)
            /* ->editColumn('created_at', function ($caseSession) {
        return $caseSession->created_at->format('Y-m-d');
        })*/
            ->addColumn('select', static function () {
                return null;
            })
            ->addColumn('service', function ($besoin) {
                if ($besoin->service) {
                    return $besoin->service->libelle;
                }
                return null;
            })
            ->addColumn('action', $dataAction)
            ->rawColumns(['id', 'service', 'action'])
            ->make(true);
    }
    public function getLigneBesoinsByBesoin($besoin_id, $mode)
    {
        $dataAction = "besoins.lignebesoin-datatable-actions";
        if($mode =="validation"){
            $dataAction = "besoins.validation.lignebesoin-datatable-actions";
        }

         $query = LignesBesoin::select('*')->with('besoin')->with('nature_demande')->where('besoins_id', $besoin_id);
        Log::info("mode ligne besoin is ".$mode);
        Log::info("query result is  ".$query->get());

        return datatables()
            ->of($query)
            /* ->editColumn('created_at', function ($caseSession) {
        return $caseSession->created_at->format('Y-m-d');
        })*/
            ->addColumn('select', static function () {
                return null;
            })
            ->editColumn('description', function ($lignesBesoin) {

                return Str::words($lignesBesoin->description,5);
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
                if ($lignesBesoin->nature_demande) {
                    return $lignesBesoin->nature_demande->libelle;
                }
                return "";
            })
            ->addColumn('valider', function ($lignesBesoin) {
                if ($lignesBesoin->besoin) {
                    return $lignesBesoin->besoin->valider;
                }
                return false;
            })
            ->addColumn('action_file', 'besoins.file-actions')
            ->addColumn('action', $dataAction)
            ->rawColumns(['id', 'valider', 'type_demande', 'nature_demandes_id', 'action_file', 'action'])
            ->make(true);
    }

    public function getBesoinByParam($key,$value){
        return Besoin::Select('*')->where($key, '=', $value)
                                 ->get()->first();
    }
    public function getBesoinLigneBesoinByParam($key,$value){
        return Besoin::Select('*')->with('lignes_besoins')->where($key, '=', $value)
                                 ->get()->first();
    }
    public function validerBesoin($id)
    {
        Besoin::find($id)->update([
            'valider'=>true,
        ]);
       // return Response()->json(['success' => 'Projet deleted successfully.']);
    }
    public function destroy($id)
    {
        Besoin::find($id)->delete();
       // return Response()->json(['success' => 'Projet deleted successfully.']);
    }
    public function multiDestroy($ids){
        Besoin::whereIn('id', $ids)->delete();
    }

}
