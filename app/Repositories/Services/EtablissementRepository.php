<?php

namespace App\Repositories\Services;

use App\Repositories\Interfaces\IEtablissementRepository;
use App\Models\Etablissement;
use Illuminate\Support\Facades\Validator;

class EtablissementRepository implements IEtablissementRepository
{
    public function create($input)
    {   
        Etablissement::create($input);
    }

    public function update($input, $id)
    {   
        $etablissement = Etablissement::find($id);
        $etablissement->update($input);
    }
}
 