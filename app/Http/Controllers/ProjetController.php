<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Repositories\IProjetRepository;
use Illuminate\Http\Request; 

class ProjetController extends Controller
{
    public function __construct(IProjetRepository $repository)
    {
        $this->repository = $repository;
    }

    //return Projet selected 
    public function getProjetSelected(Request $request)
    {
        $data = Projet::find($request->id);
        return Response()->json($data);
    }

    //create or update projet
    public function createOrUpdate(Request $request)
    { 
        return $this->repository->createOrUpdate($request);
    }

    // return all projets to dataTable 
    public function getAllProjetDatatable(Request $request)
    {
            return $this->repository->getAllProjet();
   
    }
 
    //delete projet
    public function destroy(Request $request)
    {   $id=$request->id;
       
        return  $this->repository->delete($id);
    }
}
