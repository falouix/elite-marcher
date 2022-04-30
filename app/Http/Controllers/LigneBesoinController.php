<?php

namespace App\Http\Controllers;

use App\Models\Besoin;
use App\Models\Service;
use App\Repositories\ILigneBesoinRepository;
use Illuminate\Http\Request;

class LigneBesoinController extends Controller
{
   
    public function __construct(ILigneBesoinRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $list = Service::get();
        return view('demande_budget.ligneBesoin')->with("list", $list);
    }

    public function createOrUpdate(Request $request)
    {
        return $this->repository->createOrUpdate($request);
    }

    public function getAllLigneBesoinDatatable(Request $request)
    {
        return $this->repository->getAllLigneBesoin($request);
    }

    public function edit(Request $request)
    {
        return $this->repository->f_edit($request->id);
    }
   
    public function destroy(Request $request)
    {
        $id = $request->id;
        return  $this->repository->delete($id);
    }
}
