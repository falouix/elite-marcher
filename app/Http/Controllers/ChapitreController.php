<?php

namespace App\Http\Controllers;

use App\Models\Chapitre;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\IChapitreRepository;
use Validator;

class ChapitreController extends Controller
{
    public function __construct(IChapitreRepository $repository)
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
        return view('chapitres.index');
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
            'libelle' => 'required'
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

        $chapitre = Chapitre::find($id);
        return response()->json($chapitre);
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

    public function getAllChapitresDatatable(Request $request)
    {
        if ($request->ajax()) {
            return $this->repository->getAllChapitres();
        }
    }
}
