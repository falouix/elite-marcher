<?php
namespace App\Repositories\Interfaces;

interface IBesoinRepository {
    public function getAllBesoin($viewSource);
    public function createOrUpdate($request);
    public function delete($id);
}
