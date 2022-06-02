<?php

namespace App\Repositories\Services;

use App\Repositories\Interfaces\IBesoinRepository;
use App\Models\Besoin;


class BesoinRepository implements IBesoinRepository
{
    public function createOrUpdate($request)
    {
        $request->validate(
            [
                'date_besoin' => 'required',
                'demandeur' => 'required',
                'libelle' => 'required',
                'annee_gestion' => 'required|max:4|min:4'
            ],

        );
        $besoin = Besoin::updateOrCreate(
            ['id' => $request->besoinsId],
            [
                'date_besoin' => $request->date_besoin,
                'demandeur' => $request->demandeur,
                'libelle' => $request->libelle,
                'annee_gestion' => $request->annee_gestion,
                'valider' => $request->valider,
                'date_validation' => $request->date_validation,
                'services_id' => $request->services_id,
            ]
        );
        return $besoin;
    }

    public function getAllBesoin()
    {
        $query = Besoin::select('*')->with('lignes_besoins')->with('service');
        Log::info($query->get());
        return datatables()
        ->of($query)
        ->addColumn('select', static function () {
            return null;
        })
        ->addColumn('demandeur', static function () {
            return null;
        })
        ->addColumn('action', 'besoins.datatable-actions')

        ->rawColumns(['id', 'action'])

        ->make(true);
    }

    public function delete($id)
    {
        Besoin::find($id)->delete();
        return Response()->json(['success' => 'Projet deleted successfully.']);
    }
}
