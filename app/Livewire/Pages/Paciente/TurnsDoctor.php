<?php

namespace App\Livewire\Pages\Paciente;

use Livewire\Component;
use App\Repositories\TurnRepository;
use App\Repositories\DoctorRepository;
use App\Traits\LogoutTrait;

class TurnsDoctor extends Component
{
    use LogoutTrait;

    public $id;
    public $name;
    public $turns_availables = [];
    public $user_id;
    protected $turnRepository;
    protected $doctorRepository;

    protected $listeners = ['scheduleAppointmentConfirm'];

    public function __construct()
    {
        $this->turnRepository = new TurnRepository();
        $this->doctorRepository = new DoctorRepository();
    }

    public function mount($id)
    {
        $this->id = $id;
        $this->user_id = session('user_id');

        $this->getDoctorName();
        $this->getTurnsAvailables();
    }

    public function render()
    {
        return view('livewire.pages.paciente.turns-doctor');
    }


    public function getDoctorName()
    {
        $doctor = $this->doctorRepository->getDoctorById($this->id);  
        $this->name = $doctor->user->name;
    }

    // Obtiene los turnos disponibles del doctor
    public function getTurnsAvailables()
    {
        $turns = $this->turnRepository->getAvailableTurnsForDoctor($this->id);


        $groupedTurns = $turns->groupBy('date');


        $this->turns_availables = [];
        foreach ($groupedTurns as $date => $turnsForDate) {
            $this->turns_availables[$date] = $turnsForDate;
        }
    }


    // Confirma la cita programada
    public function scheduleAppointmentConfirm($turnId)
    {
        $this->scheduleAppointment($turnId);
    }

    // Programa una cita
    public function scheduleAppointment($turnId)
    {
        $turn = $this->turnRepository->getTurnById($turnId);
        

        if ($turn) {
            $update = $turn->update([
                'user_id' => $this->user_id,
                'status' => 'unavailable'
            ]);


            if ($update) {
                session()->flash('turnAssignment', 'Turno asignado correctamente.');

                $this->getTurnsAvailables($this->id);
            }
        }
    }
}
