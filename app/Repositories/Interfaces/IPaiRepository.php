<?php
namespace App\Repositories\Interfaces;

interface IPaiRepository {
    public function getPAI($services_id, $annee_gestion, $type_demande, $nature_demande, $mode);
}
