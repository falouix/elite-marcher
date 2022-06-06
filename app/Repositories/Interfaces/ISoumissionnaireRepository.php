<?php

namespace App\Repositories\Interfaces;

interface ISoumissionnaireRepository
{
    public function create($input);
    public function update($request, $id);

    public function getSoumissionnairetByParam($key, $value);
    public function destroy($id);
    public function getAllSoumissionnaires();
}
