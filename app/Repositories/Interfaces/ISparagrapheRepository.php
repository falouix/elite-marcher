<?php

namespace App\Repositories\Interfaces;

interface ISparagrapheRepository
{

    public function create($input);
    public function update($request, $id);
    public function destroy($id);
    public function getAllSparagraphes();
}
