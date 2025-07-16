<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class ImportUsersController extends Controller
{
    public function import(Request $request)
    {
        try {
            Excel::import(new UsersImport, $request->file('excel_file'));
    
            return redirect()->route('admin.users')->with('success', '¡Usuarios importados correctamente!');
        } catch (\Throwable $th) {
            
            Log::error('Error al importar usuarios: ' . $th->getMessage());
    
            return redirect()->route('admin.users')->with('error', '¡Error al importar usuarios!');
        }
    }
    
}
