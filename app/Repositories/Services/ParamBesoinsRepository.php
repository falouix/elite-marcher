<?php

namespace App\Repositories\Services;

use App\Models\BesoinsParam;
use App\Repositories\Interfaces\IParamBesoinsRepository;
use carbon\Carbon;
use Log;

class ParamBesoinsRepository implements IParamBesoinsRepository
{
    public function create($request)
    {
        Log::alert("Create BesoinsParam repository");
        Log::info($request);
        // dd($request);
        //dd($request['date_Article']);

        $param = BesoinsParam::create($request->all());
        return $param;
    }

    public function update($request, $id)
    {
        $input = $request->all();
        $param = BesoinsParam::find($id)->update($input);
        return $param;
    }

    public function getAllBesoinsParam()
    {
        $dataAction = "param_besoins.datatable-actions";
            $query = BesoinsParam::select('*')->orderByDesc('annee_gestion');
        return datatables()
            ->of($query)
            ->addColumn('select', static function () {
                return null;
            })

            ->addColumn('action', $dataAction)
            ->rawColumns(['id', 'action'])
            ->make(true);
    }

    public function destroy($id)
    {
        BesoinsParam::find($id)->delete();
    }
}
