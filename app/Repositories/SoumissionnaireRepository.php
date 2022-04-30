<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ISoumissionnaireRepository;
use App\Models\Soumissionnaire;
use Illuminate\Support\Facades\Validator;

class SoumissionnaireRepository implements ISoumissionnaireRepository
{
    public function createOrUpdate($request)
    {
        $soums_id = $request->id;
        $validator =  Validator::make(
            $request->all(),
            [
                'libelle' => 'required|max:45',
                'contact' => 'required|max:45',
                'adresse' => 'required|max:45',
                'code_postal' => 'required|max:6',
                'email' => 'required|email',
                'matricule_fiscale' => 'required|max:45'
            ],

        );
        if ($validator->passes()) {
            Soumissionnaire::updateOrCreate(
                ['id' => $soums_id],
                [
                    'libelle' => $request->libelle,
                    'contact' => $request->contact,
                    'adresse' => $request->adresse,
                    'code_postal' => $request->code_postal,
                    'ville' => $request->ville,
                    'tel' => $request->tel,
                    'tel_fax' => $request->tel_fax,
                    'email' => $request->email,
                    'matricule_fiscale' => $request->matricule_fiscale
                ]
            );
            return response()->json(['success' => 'Soumissionnaire saved successfully.']);
        }
        return response()->json(['error' => $validator->errors()]);
    }


    public function getAllSoumissionnaire()
    {
        $query = Soumissionnaire::select('*');

        return datatables()
            ->of($query)
            ->addColumn('action', function ($row) {
                $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="edit btn btn-success btn-sm btnEdit">تحيين
                </a> <a href="javascript:void(0)"  data-id="' . $row->id . '" class="delete btn btn-danger btn-sm btnDelete">حذف
                </a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    public function f_edit($id)
    {
        return Response()->json(Soumissionnaire::find($id));
    }


    public function delete($id)
    {
        Soumissionnaire::find($id)->delete();
        return Response()->json(['success' => 'Soumissionnaire deleted successfully.']);
    }
}
