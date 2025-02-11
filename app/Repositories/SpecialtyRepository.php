<?php

namespace App\Repositories;

use App\Models\Specialty;

class SpecialtyRepository
{
    public function getAll()
    {
        return Specialty::all();
    }

    public function getById($id)
    {
        return Specialty::find($id);
    }

    public function create(array $data)
    {
        return Specialty::create($data);
    }

    public function update($id, array $data)
    {
        $specialty = $this->getById($id);
        return $specialty ? $specialty->update($data) : false;
    }

    public function delete($id)
    {
        $specialty = $this->getById($id);
        return $specialty ? $specialty->delete() : false;
    }
}
