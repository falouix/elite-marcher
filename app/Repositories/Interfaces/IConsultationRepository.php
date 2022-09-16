<?php
namespace App\Repositories\Interfaces;

interface IConsultationRepository {
    public function getConsultationWithRelations($id);
}
