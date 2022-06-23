<?php

namespace App\Repositories\Services;

use App\Models\NatureDemande;
use App\Repositories\Interfaces\INatureDemandeRepository;
use carbon\Carbon;
use Log;

class NatureDemandeRepository implements INatureDemandeRepository
{
    public function create($request)
    {
        Log::alert("Create Nature Demande Request");
        Log::info($request['libelle']);
        // dd($request);
        //dd($request['date_NatureDemande']);
        $NatureDemande = NatureDemande::create($request);
        return $NatureDemande;
    }
    public function update($request, $id)
    {
        $input = $request->all();

        $NatureDemande = NatureDemande::find($id);
        $NatureDemande->update($input);
        return $NatureDemande;
    }

    public function getAllNatureDemande()
    {
        $dataAction = "natures_demande.datatable-actions";

            $query = NatureDemande::select('*')
                                    ->orderByDesc('libelle');
        return datatables()
            ->of($query)
            ->addColumn('select', static function () {
                return null;
            })
            ->editColumn('type', static function ($naturedemande) {

                switch ($naturedemande->type) {
                    case 1:
                        return '<label class="badge badge-info"> مواد وخدمات </label>';
                        case 2:
                            return '<label class="badge badge-success"> أشغال </label>';

                    default:
                    return '<label class="badge badge-primary"> دراسات </label>';
                }
            })
            ->addColumn('action', $dataAction)
            ->rawColumns(['id', 'type', 'action'])
            ->make(true);
    }
    public function getNatureDemandeSelect($type){
        return ['results' =>NatureDemande::select('id','libelle as text')->where('type',$type)->orderBy('libelle')->get()];
    }
    public function destroy($id)
    {
        NatureDemande::find($id)->delete();
       // return Response()->json(['success' => 'Projet deleted successfully.']);
    }
    public function multiDestroy($ids){
        NatureDemande::whereIn('id', $ids)->delete();
    }

}
