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
            [
                'date_besoin.required' => 'حقل التاريخ مطلوب.',
                'demandeur.required' => 'حقل الطالب مطلوب.',
                'libelle.required' => 'حقل المصلحة/الدائرة/المؤسسة مطلوب.',

                'annee_gestion.required' => 'حقل السنة المالية مطلوب.',
                'annee_gestion.max' => ' يجب أن لا تزيد السنة المالية عن 4 ارقام .',
                'annee_gestion.min' => ' يجب أن لا تقل السنة المالية عن 4 ارقام.',
            ]
        );
        Besoin::updateOrCreate(
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
        return back()->with('success', 'تم حفظ ضبط الحاجيات بنجاح.');
    }

    public function getAllBesoin($viewSource)
    {
        $query = Besoin::select('*');
        if ($viewSource != 'besoin') {
            return datatables()
                ->of($query)
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="/confirmationDemande?id=' . $row->id . '&valider=' . $row->valider . '" class="btn btn-success feather icon-check-circle">المصادقة
                    </a>';
                    return $actionBtn;
                })->rawColumns(['action'])
                ->make(true);
        } else {
            return datatables()
                ->of($query)
                ->addColumn('action', function ($row) {

                    $actionBtn = '<a href="/ligneBesoin?id=' . $row->id . '"  class="edit btn btn-success btn-sm btnEdit">تحيين
                    </a> <a href="javascript:void(0)"  data-id="' . $row->id . '" class="delete btn btn-danger btn-sm btnDelete">حذف
                    </a> ';
                    return $actionBtn;
                })->rawColumns(['action'])
                ->make(true);
        }
    }

    public function delete($id)
    {
        Besoin::find($id)->delete();
        return Response()->json(['success' => 'Projet deleted successfully.']);
    }
}
