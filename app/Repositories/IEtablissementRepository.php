<?php
namespace App\Repositories\Interfaces;

interface IEtablissementRepository {
    public function createOrUpdate($request);
    public function getEtablissement();
}
