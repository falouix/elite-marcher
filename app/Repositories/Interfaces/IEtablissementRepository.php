<?php
namespace App\Repositories\Interfaces;

interface IEtablissementRepository {
    public function create($input);
    public function update($input, $id);
}
  