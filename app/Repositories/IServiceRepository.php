<?php

namespace App\Repositories\Interfaces;

interface IServiceRepository
{
    public function getAllService();
    public function f_edit($id);
    public function createOrUpdate($request);
    public function delete($id);
}
