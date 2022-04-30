<?php

namespace App\Repositories\Interfaces;

interface ISoumissionnaireRepository
{
    public function getAllSoumissionnaire();
    public function f_edit($id);
    public function createOrUpdate($request);
    public function delete($id);
}
