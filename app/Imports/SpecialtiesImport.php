<?php

namespace App\Imports;

use App\Models\Specialty;
use Maatwebsite\Excel\Concerns\ToModel;


class SpecialtiesImport implements ToModel
{
    public function model(array $row)
    {
        return new Specialty([
            'specialty' => $row[0],
        ]);
    }
}
