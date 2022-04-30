<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Repositories\Interfaces\IServiceRepository;
use Illuminate\Http\Request;
use Datatables;

class ServicesController extends Controller
{
    public function __construct(IServiceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllServiceDatatable(Request $request)
    {
        if ($request->ajax()) {
            return $this->repository->getAllService();
        }
    }

    public function edit(Request $request)
    {
        return $this->repository->f_edit($request->id);
    }

    public function createOrUpdate(Request $request)
    {
        return $this->repository->createOrUpdate($request);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        return  $this->repository->delete($id);
    }
}
