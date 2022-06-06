<?php

namespace App\Http\Controllers;

use App\Models\Etablissement;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\IEtablissementRepository;
class EtablissementController extends Controller
{

    public function __construct(IEtablissementRepository $repository)
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
        $etablissement = Etablissement::find(1);
        return view('etablissements.index', compact('etablissement')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
        $this->repository->create($request->all());
        return view('etablissements.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Etablissement  $etablissement
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Etablissement  $etablissement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $this->repository->update($request->all(), $id);
        return redirect()->route('etablissements.index');
    }
}
