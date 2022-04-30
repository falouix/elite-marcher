<?php
namespace App\Repositories\Interfaces;

interface ILigneBesoinRepository {
    public function getAllLigneBesoin($request);
    public function f_edit($id);
    public function createOrUpdate($request);
    public function delete($id);
}
