<?php

namespace App\Livewire\Pages\Admin\Statistics;

use Livewire\Component;
use App\Models\Turn;
use App\Models\Doctor;
use App\Models\User;
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
        $workHoursVsAppointments = $this->getWorkHoursVsAppointments();
        $patientsActive = $this->getPatientsActive();
        $newPatients = $this->getNewPatients();
        $averageAppointmentsPerPatient = $this->getAverageAppointmentsPerPatient();

        return view('livewire.pages.admin.statistics.turns-statistics', compact(
            'turnsToday',
            'turnsWeek',
            'turnsMonth',
            'turnsBySpecialty',
            'turnsByDoctor',
            'patientsByDoctor',
            'rankingDoctors',
            'workHoursVsAppointments',
            'patientsActive',
            'newPatients',
            'averageAppointmentsPerPatient'
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


    public function getWorkHoursVsAppointments()
    {
        $doctors = Doctor::with(['schedules', 'turns' => function ($query) {
            $query->where('status', 'unavailable');
        }])->get();

        $estadisticas = $doctors->map(function ($doctor) {
            $workHours = $doctor->schedules->sum(function ($schedule) {
                $start = \Carbon\Carbon::parse($schedule->start_time);
                $end = \Carbon\Carbon::parse($schedule->end_time);
                return $end->diffInMinutes($start) / 60;
            });


            $turns = $doctor->turns->count();

            return [
                'doctor' => $doctor->name,
                'work_hours' => $workHours,
                'turns' => $turns,
            ];
        });
    }


    public function getPatientsActive()
    {
        $oneYearAgo = Carbon::now()->subYear();

        $active = User::whereHas('roles', fn($q) => $q->where('name', 'paciente'))
            ->whereHas('turns', fn($q) => $q->where('date', '>=', $oneYearAgo))
            ->count();

        $total = User::whereHas('roles', fn($q) => $q->where('name', 'paciente'))->count();

        return [
            'activos' => $active,
            'inactivos' => $total - $active,
        ];
    }


    public function getAverageAppointmentsPerPatient()
    {
        $totalAppointments = Turn::where('status', 'unavailable')->count();
        $totalPatients = User::whereHas('roles', fn($q) => $q->where('name', 'paciente'))->count();

        if ($totalPatients === 0) {
            return 0;
        }

        return round($totalAppointments / $totalPatients, 2);
    }


    public function getNewPatients()
    {
        $patientsLastDay = User::whereHas('roles', fn($q) => $q->where('name', 'paciente'))
            ->where('created_at', '>=', Carbon::now()->subDay())
            ->count();

        $patientsLastWeek = User::whereHas('roles', fn($q) => $q->where('name', 'paciente'))
            ->where('created_at', '>=', Carbon::now()->subWeek())
            ->count();

        $patientsLastMonth = User::whereHas('roles', fn($q) => $q->where('name', 'paciente'))
            ->where('created_at', '>=', Carbon::now()->subMonth())
            ->count();

        return [
            'patientsLastDay' => $patientsLastDay,
            'patientsLastWeek' => $patientsLastWeek,
            'patientsLastMonth' => $patientsLastMonth,
        ];
    }
}
