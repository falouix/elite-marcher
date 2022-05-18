<?php

namespace App\Repositories\Interfaces;

interface ISoumissionnaireRepository
{
    public function create($input);
    public function edit($id);
    public function update($request, $id);
    public function destroy($id);
    public function getAllSoumissionnaires();
}
