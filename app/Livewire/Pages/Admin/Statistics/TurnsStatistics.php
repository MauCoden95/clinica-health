<?php

namespace App\Livewire\Pages\Admin\Statistics;

use Livewire\Component;
use App\Models\Turn;
use App\Models\Doctor;
use Carbon\Carbon;

class TurnsStatistics extends Component
{
    public function render()
    {
        $turnsToday = $this->count_turns_by_day();
        $turnsWeek = $this->count_turns_by_week();
        $turnsMonth = $this->count_turns_by_month();
        $turnsBySpecialty = $this->turns_by_specialty()->toArray();
        $turnsByDoctor = $this->turns_by_doctor()->toArray();
        $patientsByDoctor = $this->patients_by_doctor()->toArray();
        $rankingDoctors = $this->ranking_doctors_by_turns()->toArray();
        
        

        return view('livewire.pages.admin.statistics.turns-statistics', compact(
            'turnsToday',
            'turnsWeek',
            'turnsMonth',
            'turnsBySpecialty',
            'turnsByDoctor',
            'patientsByDoctor',
            'rankingDoctors'
        ));
    }


    public function count_turns_by_day()
    {
        $today = Carbon::today();

        $turnsToday = Turn::whereDate('date', $today)
            ->where('status', 'unavailable')
            ->count();

        return $turnsToday;
    }

    public function count_turns_by_month()
    {
        $today = Carbon::today();

        $turnsMonth = Turn::whereMonth('date', $today)
            ->where('status', 'unavailable')
            ->count();

        return $turnsMonth;
    }

    public function count_turns_by_week()
    {
        $today = Carbon::today();

        $turnsWeek = Turn::whereRaw('WEEK(`date`, 1) = ?', [$today->weekOfYear])
            ->whereYear('date', $today->year)
            ->where('status', 'unavailable')
            ->count();


        return $turnsWeek;
    }

    public function turns_by_specialty()
    {
        $turnsBySpecialty = Turn::with('doctor.specialty')
            ->where('status', 'unavailable')
            ->get()
            ->groupBy(function ($turn) {
                return $turn->doctor->specialty->specialty ?? 'Sin especialidad';
            })
            ->map(function ($group) {
                return $group->count();
            });

        return $turnsBySpecialty;
    }


    public function turns_by_doctor()
    {
        $turnsByDoctor = Turn::with('doctor')
            ->where('status', 'unavailable')
            ->get()
            ->groupBy(function ($turn) {
                return $turn->doctor->name ?? 'Sin doctor';
            })
            ->map(function ($group) {
                return $group->count();
            });

        return $turnsByDoctor;
    }


    public function patients_by_doctor()
    {
        $now = Carbon::now();

        $turns = Turn::with('doctor')
            ->whereMonth('date', $now->month)
            ->whereYear('date', $now->year)
            ->get()
            ->groupBy('doctor.id')
            ->map(function ($turnsPorDoctor) {
                $doctor = $turnsPorDoctor->first()->doctor;
                $pacientesUnicos = $turnsPorDoctor->pluck('user_id')->unique()->count();

                return [
                    'doctor' => $doctor->name,
                    'total_pacientes' => $pacientesUnicos,
                ];
            })
            ->values();

        return $turns;
    }


    public function ranking_doctors_by_turns()
    {
        $ranking = Doctor::withCount(['turns' => function ($query) {
            $query->where('status', 'unavailable');
        }])
            ->orderBy('turns_count', 'desc')
            ->take(3)
            ->get();


        return $ranking;
    }
}
