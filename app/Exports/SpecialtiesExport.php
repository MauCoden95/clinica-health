<?php

namespace App\Exports;

use App\Models\Specialty;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SpecialtiesExport implements FromCollection, WithMapping, WithHeadings
{
    public function collection()
    {
        return Specialty::all();
    }

    public function headings(): array
    {
        return [
            'Especialidad',
        ];
    }

    public function map($specialty): array
    {
        return [
            $specialty->specialty,
        ];
    }
}
