<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;
use App\Exports\SpecialtiesExport;
use App\Imports\SpecialtiesImport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Specialty $specialty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Specialty $specialty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Specialty $specialty)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialty $specialty)
    {
        //
    }

    public function import(Request $request)
    {
        try {
            Excel::import(new SpecialtiesImport, $request->file('excel_file'));

            return redirect()->route('admin.specialty')->with('success', '¡Especialidades importadas correctamente!');
        } catch (\Throwable $th) {

            Log::error('Error al importar especialidades: ' . $th->getMessage());

            return redirect()->route('admin.specialty')->with('error', '¡Error al importar especialidades!');
        }
    }

    public function export()
    {
        return Excel::download(new SpecialtiesExport, 'especialidades.xlsx');
    }
}
