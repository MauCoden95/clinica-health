<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Models\Turn;
use Carbon\Carbon;
use App\Traits\LogoutTrait;

class Calendar extends Component
{
    use LogoutTrait;

    public $events = [];
    public $turns = [];
    public $turnsByPatient = [];
    public $selectedDate;
    public $todayDate = '';

    /**
     * Función que se ejecuta al montar el componente, carga los eventos (turnos) y 
     * asigna la fecha de hoy a la variable $todayDate
     */
    public function mount()
    {
        $this->loadEvents();
        $this->todayDate = Carbon::now()->format('d-m-y');
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
}
