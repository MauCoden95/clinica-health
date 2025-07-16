<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\SuppliersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SuppliersExport;
use Illuminate\Support\Facades\Log;

class ImportSuppliersController extends Controller
{
    public function import(Request $request)
    {
        try {
            Excel::import(new SuppliersImport, $request->file('excel_file'));

            return redirect()->route('admin.suppliers')->with('success', 'Proveedores importados correctamente!');
        } catch (\Throwable $th) {

            Log::error('Error al importar proveedores: ' . $th->getMessage());

            return redirect()->route('admin.suppliers')->with('error', '¡Error al importar proveedores!');
        }
    }


    public function export()
    {
        return Excel::download(new SuppliersExport, 'proveedores.xlsx');
    }
}
