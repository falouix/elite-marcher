<?php

namespace App\Repositories\Services;

use App\Models\Titre;
use App\Repositories\Interfaces\ITitreRepository;
use Log;

class TitreRepository implements ITitreRepository
{
    public function create($input)
    {
        Log::info($input);
        $titre = Titre::create($input);
        return $titre;
    }

    public function update($request, $id)
    {
        $input = $request->all();
        $titre = Titre::find($id);
        $titre->update($input);
    }

    public function destroy($id)
    {
        Titre::find($id)->delete();
    }

    public function getAllTitres()
    {
        $query = Titre::select('*');

        return datatables()
            ->of($query)
            ->addColumn('select', static function () {
                return null;
            })
            ->addColumn('action', 'titres.datatable-actions')

            ->rawColumns(['action'])

            ->make(true);
    }
}
