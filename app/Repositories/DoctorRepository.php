<?php

namespace App\Repositories;

use App\Models\Doctor;
use Illuminate\Support\Facades\DB;

class DoctorRepository
{
    public function getTopThreeSpecialties()
    {
        return Doctor::select('specialties.specialty', DB::raw('count(*) as total'))
            ->join('turns', 'doctors.id', '=', 'turns.doctor_id')
            ->join('specialties', 'doctors.specialty_id', '=', 'specialties.id')
            ->where('turns.status', 'unavailable')
            ->groupBy('specialties.specialty')
            ->orderBy('total', 'desc')
            ->limit(3)
            ->get();
    }

    public function getTopThreeDoctors()
    {
        return Doctor::select('users.name', DB::raw('count(*) as total'))
            ->join('turns', 'doctors.id', '=', 'turns.doctor_id')
            ->join('users', 'doctors.user_id', '=', 'users.id')
            ->where('turns.status', 'unavailable')
            ->groupBy('users.name')
            ->orderBy('total', 'desc')
            ->limit(3)
            ->get();
    }

    // Método para obtener un doctor por su ID
    public function getDoctorById($doctorId)
    {
        return Doctor::find($doctorId);
    }
}
