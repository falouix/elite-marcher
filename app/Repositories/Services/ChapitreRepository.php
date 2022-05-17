<?php

namespace App\Repositories\Services;

use App\Models\Chapitre;
use App\Repositories\Interfaces\IChapitreRepository;
use Log;

class ChapitreRepository implements IChapitreRepository
{
    public function create($input)
    {
        Log::info($input);
        $chapitre = Chapitre::create($input);
        return $chapitre;
    }

    public function update($request, $id)
    {
        $input = $request->all();
        $chapitre = Chapitre::find($id);
        $chapitre->update($input);
    }

    public function destroy($id)
    {
        Chapitre::find($id)->delete();
    }

    public function getAllChapitres()
    {
        $query = Chapitre::select('*');

        return datatables()
            ->of($query)
            ->addColumn('select', static function () {
                return null;
            })
            ->addColumn('action', 'chapitres.datatable-actions')

            ->rawColumns(['action'])

            ->make(true);
    }
}
