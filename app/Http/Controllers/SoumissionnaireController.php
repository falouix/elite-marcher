<?php

namespace App\Http\Controllers;
use App\Repositories\Interfaces\ISoumissionnaireRepository;
use Illuminate\Http\Request;
use App\Models\Soumissionnaire;
use Datatables;
class SoumissionnaireController extends Controller
{
    public function __construct(ISoumissionnaireRepository $repository)
    {
        $this->repository = $repository;
    }
    public function getAllSoumissionnaireDatatable(Request $request)
    {
        if ($request->ajax())
        {
           return $this->repository->getAllSoumissionnaire();
        }
    }
    public function edit (Request $request)
    {
        return $this->repository->f_edit($request->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Soumissionnaire  $soumissionnaire
     * @return \Illuminate\Http\Response
     */
    public function createOrUpdate (Request $request)
    {
        return $this->repository->createOrUpdate($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Soumissionnaire  $soumissionnaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {   $id=$request->id;

        return  $this->repository->delete($id);
    }
}
