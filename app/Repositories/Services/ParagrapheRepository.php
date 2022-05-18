<?php

namespace App\Repositories\Services;

use App\Models\Paragraphe;
use App\Repositories\Interfaces\IParagrapheRepository;
use Log;

class ParagrapheRepository implements IParagrapheRepository
{
    public function create($input)
    {
        Log::info($input);
        $paragraphe = Paragraphe::create($input);
        return $paragraphe;
    }

    public function update($request, $id)
    {
        $input = $request->all();
        $paragraphe = Paragraphe::find($id);
        $paragraphe->update($input);
    }

    public function destroy($id)
    {
        Paragraphe::find($id)->delete();
    }

    public function getAllParagraphes()
    {
        $query = Paragraphe::select('*');

        return datatables()
            ->of($query)
            ->addColumn('select', static function () {
                return null;
            })
            ->addColumn('action', 'paragraphes.datatable-actions')

            ->rawColumns(['action'])

            ->make(true);
    }
}
