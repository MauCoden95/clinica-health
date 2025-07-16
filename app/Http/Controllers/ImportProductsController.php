<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductsExport;
use Illuminate\Support\Facades\Log;

class ImportProductsController extends Controller
{
    public function import(Request $request)
    {
        try {
            Excel::import(new ProductsImport, $request->file('excel_file'));

            return redirect()->route('admin.products')->with('success', 'Productos importados correctamente!');
        } catch (\Throwable $th) {

            Log::error('Error al importar usuarios: ' . $th->getMessage());

            return redirect()->route('admin.products')->with('error', '¡Error al importar productos!');
        }
    }


    public function export()
    {
        return Excel::download(new ProductsExport, 'productos.xlsx');
    }
}
