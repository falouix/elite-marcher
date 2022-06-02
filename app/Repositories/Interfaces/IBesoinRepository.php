<?php
namespace App\Repositories\Interfaces;

interface IBesoinRepository {
    public function getAllBesoin();
    public function createOrUpdate($request);
    public function delete($id);
}
