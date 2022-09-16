<?php

namespace App\Repositories\Services;

use App\Repositories\Interfaces\IConsultationRepository;
use App\Models\DossiersAchat;
//use App\Models\LignesProjet;
use App\Models\LignesDossier;
use Log;

class ConsultationRepository implements IConsultationRepository
{
    public function getConsultationWithRelations($id){
        return DossiersAchat::select('*')
                                ->where('id', $id)
                                ->firs();
    }
}
