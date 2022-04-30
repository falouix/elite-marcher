<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IServiceRepository;
use App\Models\Service;
use Illuminate\Support\Facades\Validator;

class ServiceRepository implements IServiceRepository
{
    public function createOrUpdate($request)
    {
        $validator =  Validator::make(
            $request->all(),
            [
                'libelle' => 'required|max:191',
                'contact' => 'required|max:191',
                'responsable' => 'required|max:45'
            ],
            [
                'libelle.required' => 'حقل اسم المصلحة/الدائرة/ المؤسسة مطلوب.',
                'libelle.max' => ' يجب أن لا يزيد اسم المصلحة/الدائرة/ المؤسسة عن 191 حرفًا.',

                'contact.required' => 'حقل جهة الإتصال مطلوب.',
                'contact.max' => ' يجب أن لا يزيد جهة الإتصال عن 191 حرفًا.',

                'responsable.required' => 'حقل اسم المسؤول مطلوب.',
                'responsable.max' => ' يجب أن لا يزيد اسم المسؤول عن 45 حرفًا.',
            ]
        );
        if ($validator->passes()) {
            Service::updateOrCreate(
                ['id' => $request->id],
                [
                    'libelle' => $request->libelle,
                    'contact' => $request->contact,
                    'responsable' => $request->responsable
                ]
            );
            return response()->json(['success' => 'LigneBesoin saved successfully.']);
        }
        return response()->json(['error' => $validator->errors()]);
    }


    public function getAllService()
    {
        $query = Service::select('*');

        return datatables()
            ->of($query)
            ->addColumn('action', function ($row) {
                $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="edit btn btn-success btn-sm btnServiceEdit">تحيين
                </a> <a href="javascript:void(0)"  data-id="' . $row->id . '" class="delete btn btn-danger btn-sm btnServiceDelete">حذف
                </a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    public function f_edit($id)
    {
        return Response()->json(Service::find($id));
    }


    public function delete($id)
    {
        Service::find($id)->delete();
        return Response()->json(['success' => 'service deleted successfully.']);
    }
}
