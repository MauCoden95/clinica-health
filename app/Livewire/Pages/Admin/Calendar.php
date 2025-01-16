<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Models\Turn;
use App\Models\Doctor;
use App\Models\User;
use Carbon\Carbon;
use App\Traits\LogoutTrait;
use Illuminate\Support\Facades\DB;

class Calendar extends Component
{
    use LogoutTrait;

    public $events = [];
    public $turns = [];
    public $turnsByPatient = [];
    public $selectedDate;
    public $todayDate = '';
    public $occupation_day = 50;
    public $topThreeSpecialties = [];
    public $topThreeDoctors = [];
    public $patients = [];

    /**
     * Función que se ejecuta al montar el componente, carga los eventos (turnos) y 
     * asigna la fecha de hoy a la variable $todayDate
     */
    public function mount()
    {
        $this->loadEvents();
        $this->todayDate = Carbon::now()->format('d-m-y');
        $this->occupationDay();
        $this->getTopThreeSpecialties();
        $this->getTopThreeDoctors();
        $this->patientsWithRepeatedTurns();
    }

    /**
     * Función que carga los turnos y los formatea para mostrarlos en la vista
     */
    public function loadEvents()
    {
        $this->events = Turn::with(['user', 'doctor.user', 'doctor.specialty'])
                            ->where('status', 'unavailable')
                            ->get()
                            ->map(function ($turn) {
                                return [
                                    'name_patient' => $turn->user->name,
                                    'name_doctor' => $turn->doctor->user->name,
                                    'specialty' => $turn->doctor->specialty->specialty,
                                    'date' => $turn->date,
                                    'time' => $turn->time,
                                ];
                            });
    }

    /**
     * Función que se ejecuta cuando se selecciona una fecha en el calendario, 
     * carga los turnos de esa fecha y emite un evento para que se muestren en la vista
     */
    public function showTurns($date)
    {
        $this->selectedDate = $date->format('Y-m-d');
        $this->turns = Turn::with(['user', 'doctor.specialty'])
            ->whereDate('date', $this->selectedDate)
            ->where('status', 'unavailable')
            ->get();

        $this->emit('turnsUpdated', $this->turns);
    }

    /**
     * Función que se encarga de renderizar la vista del componente, 
     * y pasa como parámetro los turnos cargados en la función showTurns
     */
    public function render()
    {
        return view('livewire.pages.admin.calendar', [
            'turns' => $this->turns,
            'occupation_day' => $this->occupation_day,
            'topThreeSpecialties' => $this->topThreeSpecialties,
            'topThreeDoctors' => $this->topThreeDoctors,
            'patients' => $this->patients
        ]);
    }

    /**
     * Función que carga los turnos de un paciente en particular
     */
    public function getTurnsByPatient($user_id){
        $turnsByPatient = Turn::with(['user', 'doctor.specialty'])
            ->where('user_id', $user_id)
            ->get();
    }


    public function occupationDay(){
        $today = Carbon::now()->format('Y-m-d');
        $total = Turn::whereDate('date', $today)->count();
        $occupied = Turn::whereDate('date', $today)->where('status', 'unavailable')->count();
        $this->occupation_day = ($occupied * 100) / $total;
    }

    
    public function getTopThreeSpecialties(){
        $this->topThreeSpecialties = Doctor::select('specialties.specialty', DB::raw('count(*) as total'))
            ->join('turns', 'doctors.id', '=', 'turns.doctor_id')
            ->join('specialties', 'doctors.specialty_id', '=', 'specialties.id')
            ->where('turns.status', 'unavailable')
            ->groupBy('specialties.specialty')
            ->orderBy('total', 'desc')
            ->limit(3)
            ->get();
    }


    
    public function getTopThreeDoctors(){
        $this->topThreeDoctors = Doctor::select('users.name', DB::raw('count(*) as total'))
            ->join('turns', 'doctors.id', '=', 'turns.doctor_id')
            ->join('users', 'doctors.user_id', '=', 'users.id')
            ->where('turns.status', 'unavailable')
            ->groupBy('users.name')
            ->orderBy('total', 'desc')
            ->limit(3)
            ->get();
    }

    
    
    public function patientsWithRepeatedTurns(){
        $startDate = Carbon::now()->startOfMonth()->subMonths(3);
        $endDate = Carbon::now()->endOfMonth();
        $this->patients = User::select('users.name', DB::raw('count(*) as total'))
            ->join('turns', 'users.id', '=', 'turns.user_id')
            ->whereBetween('turns.date', [$startDate, $endDate])
            ->groupBy('users.name')
            ->having('total', '>', 1)
            ->get();
    }
    

}
