<?php

namespace App\Repositories\Services;

use App\Repositories\Interfaces\IServiceRepository;
use App\Models\Service;
use Log;

class ServiceRepository implements IServiceRepository
{
    public function create($input)
    {
        Log::info($input);
        $service = Service::create($input);
        return $service;
    }
    public function edit($id)
    {
        return Response()->json(Service::find($id));
    }

    public function update($request, $id)
    {
        $input = $request->all();
        $service = Service::find($id);
        $service->update($input);
    }

    public function destroy($id)
    {
        Service::find($id)->delete();
    }

    public function getAllServices()
    {
        $query = Service::select('*');

        return datatables()
            ->of($query)
            ->addColumn('select', static function () {
                return null;
            })
            ->addColumn('action', 'services.datatable-actions')

            ->rawColumns(['action'])

            ->make(true);
    }
}
