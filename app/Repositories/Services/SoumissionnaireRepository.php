<?php

namespace App\Repositories\Services;

use App\Repositories\Interfaces\ISoumissionnaireRepository;
use App\Models\Soumissionnaire;
use Log;

class SoumissionnaireRepository implements ISoumissionnaireRepository
{

    public function create($input)
    {
        Log::info($input);
        $soumissionnaire = Soumissionnaire::create($input);
        return $soumissionnaire;
    }
    public function edit($id)
    {
        return Response()->json(Soumissionnaire::find($id));
    }

    public function update($request, $id)
    {
        $input = $request->all();
        $soumissionnaire = Soumissionnaire::find($id);
        $soumissionnaire->update($input);
    }

    public function destroy($id)
    {
        Soumissionnaire::find($id)->delete();
    }

    public function getAllSoumissionnaires()
    {
        $query = Soumissionnaire::select('*');

        return datatables()
            ->of($query)
            ->addColumn('select', static function () {
                return null;
            })
            ->addColumn('action', 'soumissionnaires.datatable-actions')

            ->rawColumns(['action'])

            ->make(true);
    }
}
