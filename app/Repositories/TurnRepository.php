<?php

namespace App\Repositories;

use App\Models\Turn;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TurnRepository
{
    public function getUnavailableTurns()
    {
        return Turn::with(['user', 'doctor.user', 'doctor.specialty'])
                    ->where('status', 'unavailable')
                    ->get();
    }

    public function getTurnsToday()
    {
        return Turn::with(['user', 'doctor.user', 'doctor.specialty'])
                    ->whereDate('date', Carbon::now()->format('Y-m-d'))
                    ->where('status', 'unavailable')
                    ->orderBy('time', 'asc')
                    ->get();
    }

    public function getTurnsByPatient($userId)
    {
        return Turn::with(['user', 'doctor.specialty'])
                    ->where('user_id', $userId)
                    ->get();
    }

    public function getOccupationPercentage()
    {
        $today = Carbon::now()->format('Y-m-d');
        $total = Turn::whereDate('date', $today)->count();
        $occupied = Turn::whereDate('date', $today)->where('status', 'unavailable')->count();
        return $total > 0 ? ($occupied * 100) / $total : 0;
    }

    // Método para obtener los turnos disponibles de un doctor
    public function getAvailableTurnsForDoctor($doctorId)
    {
        return Turn::with(['user', 'doctor.user', 'doctor.specialty'])
                    ->where('status', 'available')
                    ->where('doctor_id', $doctorId)
                    ->whereDate('date', '>=', Carbon::now()->toDateString()) 
                    ->orderBy('date')
                    ->get();
    }

    // Método para obtener un turno por ID
    public function getTurnById($turnId)
    {
        return Turn::find($turnId);
    }


    
}
