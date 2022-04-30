<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IProjetRepository;
use App\Models\Projet;

class ProjetRepository implements IProjetRepository
{
    public function createOrUpdate($request)
    {
        $request->validate(
            [
                'libelle' => 'required',
                'cout_total_pro' => 'required|max:12,3'
            ],
            [
                'libelle.required' => 'حقل المصلحة أو المؤسسة  مطلوب.',
                'cout_total_pro.required' => 'حقل الكلفة التقديرية الجملية للمشروع مطلوب.',
                'cout_total_pro.min' => ' يجب أن لا تزيد الكلفة التقديرية الجملية للمشروع عن 12,3 رقم .',
            ]
        );
        Projet::updateOrCreate(
            ['id' => $request->ProjetsId],
            [
                'code_pa' => $request->code_pa,
                'date_projet' => $request->date_projet,
                'libelle' => $request->libelle,
                'date_action_prevu' => $request->date_action_prevu,
                'objet' => $request->objet,
                'type_demande' => $request->type_demande,
                'nature_passation' => $request->nature_passation,
                'cout_total_pro' => $request->cout_total_pro,
                'annee_gestion' => $request->annee_gestion
            ]
        );
        return back()->with('success', 'تم حفظ مشروع الشراء بنجاح.');
    }

    public function getAllProjet()
    {
        $query = Projet::select('*');

        return datatables()
            ->of($query)
            ->addColumn('action', function ($row) {

                $actionBtn = '<a href="/ligneProjet?id=' . $row->id . '"  class="edit btn btn-success btn-sm btnEdit">تحيين
                    </a> <a href="javascript:void(0)"  data-id="' . $row->id . '" class="delete btn btn-danger btn-sm btnDelete">حذف
                    </a> ';
                return $actionBtn;
            })->rawColumns(['action'])
            ->make(true);
    }

    public function delete($id)
    {
        Projet::find($id)->delete();
        return Response()->json(['success' => 'Projet deleted successfully.']);
    }
}
