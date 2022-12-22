<?php
namespace App\Repositories;

use App\Repositories\Interfaces\ILigneBesoinRepository;
use App\Models\LignesBesoin;
use Illuminate\Support\Facades\Validator;

class LigneBesoinRepository implements ILigneBesoinRepository
{
    public function createOrUpdate($request)
    {
        $validator =  Validator::make($request->all(), [
            'libelle' => 'required',
            'qte_demande' => 'required',
            'qte_valide' => 'required',
            'cout_unite_ttc' => 'required',
            'cout_total_ttc' => 'required',
        ]);
        if ($validator->passes()) {
            LignesBesoin::updateOrCreate(
                ['id' => $request->id],
                [
                    'libelle' => $request->libelle,
                    'qte_demande'  => $request->qte_demande,
                    'qte_valide'  => $request->qte_valide,
                    'cout_unite_ttc' => $request->cout_unite_ttc,
                    'cout_total_ttc' => $request->cout_total_ttc,
                    'besoins_id' => $request->besoins_id
                ]
            );
            return response()->json(['success' => 'Service saved successfully.']);
        }
        return response()->json(['error' => $validator->errors()]);
    }

    public function getAllLigneBesoin($request)
    {
        if ($request->ajax()) {
            $query = LignesBesoin::where('besoins_id', $request->besoinsId)->get();
            return datatables()
                ->of($query)
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" class="delete btn btn-danger btn-sm btnDelete">حذف
                </a> ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function f_edit($id)
    {
        return Response()->json(LignesBesoin::find($id));
    }

    public function delete($id)
    {
        LignesBesoin::find($id)->delete();
        return Response()->json(['success' => 'service deleted successfully.']);
    }
}
