<?php

namespace App\Repositories\Interfaces;

interface IServiceRepository
{
    public function create($input);
    public function edit($id);
    public function update($request, $id);
    public function destroy($id);
    public function getAllServices();
}
