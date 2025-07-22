<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SpecialtiesImport;
use Illuminate\Support\Facades\Log;
use App\Exports\SpecialtiesExport;

class ImportSpecialtiesController extends Controller
{
    public function import(Request $request)
    {
        try {   

        Excel::import(new SpecialtiesImport, $request->file('excel_file'));

        return redirect()->back()->with('success', 'Datos importados correctamente.');
        } catch (\Throwable $th) {

            Log::error('Error al importar especialidades: ' . $th->getMessage());

            return redirect()->back()->with('error', '¡Error al importar especialidades!');
        }
    }


    public function export()
    {
        return Excel::download(new SpecialtiesExport, 'Especialidades.xlsx');
    }
}
