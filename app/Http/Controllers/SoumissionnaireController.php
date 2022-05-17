<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\ISoumissionnaireRepository;
use Illuminate\Http\Request;
use Validator;

class SoumissionnaireController extends Controller
{
    public function __construct(ISoumissionnaireRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('soumissionnaires.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'libelle' => 'required',
            'contact' => 'required',
            'adresse' => 'required',
            'code_postal' => 'required',
            'ville' => 'required',
            'tel_fax' => 'required',
            'email' => 'required',
            'matricule_fiscale' => 'required'
        ]);
        $this->repository->create($request->all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->repository->edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'libelle' => 'required',
            'contact' => 'required',
            'adresse' => 'required',
            'code_postal' => 'required',
            'ville' => 'required',
            'tel_fax' => 'required',
            'email' => 'required',
            'matricule_fiscale' => 'required'
        ]);
        $this->repository->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->destroy($id);
    }

    public function getAllSoumissionnairesDatatable(Request $request)
    {
        if ($request->ajax()) {
            return $this->repository->getAllSoumissionnaires();
        }
    }
}
