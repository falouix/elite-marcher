<?php

namespace App\Repositories\Services;

use App\Models\Besoin;
use App\Models\LignesBesoin;
use App\Repositories\Interfaces\IBesoinRepository;
use carbon\Carbon;
use Log;

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

    public function getAllBesoin($services_id, $start_date, $end_date, $status , $mode)
    {
        $dataAction = "besoins.datatable-actions";
        if($mode =="validation"){
            $dataAction = "besoins.validation.datatable-actions";
        }
        if (($start_date && $end_date) == false) {
            $start_date = \Carbon\Carbon::now()->firstOfMonth()->toDateString();
            $end_date = \Carbon\Carbon::now()->toDateString();

        }
        if ($services_id != 'all') {
            if($status == 'all'){
                $query = Besoin::select('*')
                // ->with('lignes_besoins')
                    ->with('service')
                    ->where('services_id', $services_id)

                    ->whereBetween('date_besoin', [$start_date, $end_date])
                    ->orderByDesc('id');
            }else{
                $query = Besoin::select('*')
            // ->with('lignes_besoins')
                ->with('service')
                ->where('services_id', $services_id)
                ->where('valider', $status)
                ->whereBetween('date_besoin', [$start_date, $end_date])
                ->orderByDesc('id');
            }


        } else {
            if($status == 'all'){
            $query = Besoin::select('*')
            // ->with('lignes_besoins')
                ->with('service')
                //->where('valider', $status)
                ->whereBetween('date_besoin', [$start_date, $end_date])
                ->orderByDesc('id');
            }else{
                $query = Besoin::select('*')
                // ->with('lignes_besoins')
                    ->with('service')
                    ->where('valider', $status)
                    ->whereBetween('date_besoin', [$start_date, $end_date])
                    ->orderByDesc('id');
            }
        }
        Log::info($query->get());

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

         $query = LignesBesoin::select('*')->with('besoin')->where('besoins_id', $besoin_id);
        Log::info("mode ligne besoin is ".$mode);

        return datatables()
            ->of($query)
            /* ->editColumn('created_at', function ($caseSession) {
        return $caseSession->created_at->format('Y-m-d');
        })*/
            ->addColumn('select', static function () {
                return null;
            })
            ->addColumn('valider', function ($lignesBesoin) {
                if ($lignesBesoin->besoin) {
                    return $lignesBesoin->besoin->valider;
                }
                return false;
            })

            ->addColumn('action', $dataAction)
            ->rawColumns(['id', 'valider', 'action'])
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
    public function destroy($id)
    {
        Besoin::find($id)->delete();
       // return Response()->json(['success' => 'Projet deleted successfully.']);
    }
    public function multiDestroy($ids){
        Besoin::whereIn('id', $ids)->delete();
    }

}
