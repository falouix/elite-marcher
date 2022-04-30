<?php
namespace App\Repositories\Interfaces;

interface IProjetRepository {
    public function getAllProjet();
    public function createOrUpdate($request);
    public function delete($id);
}
