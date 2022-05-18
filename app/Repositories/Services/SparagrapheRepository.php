<?php

namespace App\Repositories\Services;

use App\Models\Sparagraphe;
use App\Repositories\Interfaces\ISparagrapheRepository;
use Log;

class SparagrapheRepository implements ISparagrapheRepository
{
    public function create($input)
    {
        Log::info($input);
        $Sparagraphe = Sparagraphe::create($input);
        return $Sparagraphe;
    }

    public function update($request, $id)
    {
        $input = $request->all();
        $Sparagraphe = Sparagraphe::find($id);
        $Sparagraphe->update($input);
    }

    public function destroy($id)
    {
        Sparagraphe::find($id)->delete();
    }

    public function getAllSparagraphes()
    {
        $query = Sparagraphe::select('*');

        return datatables()
            ->of($query)
            ->addColumn('select', static function () {
                return null;
            })
            ->addColumn('action', 'Sparagraphes.datatable-actions')

            ->rawColumns(['action'])

            ->make(true);
    }
}
