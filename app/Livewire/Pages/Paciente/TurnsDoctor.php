<?php

namespace App\Livewire\Pages\Paciente;

use Livewire\Component;
use App\Models\Doctor;
use App\Models\Turn;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Traits\LogoutTrait;




class TurnsDoctor extends Component
{
    use LogoutTrait;

    public $id;
    public $name;
    public $turns_availables;
    public $user_id;
    public $turns;
    

    protected $listeners = ['scheduleAppointmentConfirm'];

    public function mount($id){
        $this->id = $id;

        $this->user_id = session('user_id');

        $this->getDoctorName($this->id);
        $this->getTurnsAvailables($this->id);
        
    }

    public function render()
    {
        return view('livewire.pages.paciente.turns-doctor');
    }

    
    // Obtiene el nombre del doctor
    public function getDoctorName($id){
        $doctorName = Doctor::find($id)->user->name;

        $this->name = $doctorName;
    }

    // Obtiene los turnos disponibles del doctor
    public function getTurnsAvailables($id){
        $turns = DB::table('turns')
                ->select('id','date', 'time', 'status')
                ->where('status', 'available')
                ->where('doctor_id', $id)
                ->whereDate('date', '>=', Carbon::now()->toDateString()) 
                ->orderBy('date')
                ->get();


        $turns_group = $turns->groupBy('date');

        $this->turns_availables = $turns_group;
    }

    // Confirma la cita programada
    public function scheduleAppointmentConfirm($turnId){
        $this->scheduleAppointment($turnId);
    }

    // Programa una cita
    public function scheduleAppointment($turnId){
        $turn = Turn::find($turnId);

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
