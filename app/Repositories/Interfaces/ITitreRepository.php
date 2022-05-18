<?php

namespace App\Repositories\Interfaces;

interface ITitreRepository
{

    public function create($input);
    public function update($request, $id);
    public function destroy($id);
    public function getAllTitres();
}
