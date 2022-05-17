<?php

namespace App\Repositories\Interfaces;

interface IChapitreRepository
{

    public function create($input);
    public function update($request, $id);
    public function destroy($id);
    public function getAllChapitres();
}
