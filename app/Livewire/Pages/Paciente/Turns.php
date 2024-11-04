<?php

namespace App\Livewire\Pages\Paciente;


use Livewire\Component;
use App\Models\Specialty;
use App\Models\Doctor;
use App\Traits\LogoutTrait;
use App\Models\Turn;



class Turns extends Component
{
    use LogoutTrait;

    public $specialties;
    public $specialtyId;
    public $doctors;
    public $user_id;
    public $turns;
    public $count_turns;


    public function render()
    {
        $this->getDoctors();  
        $this->loadTurns($this->user_id);

        return view('livewire.pages.paciente.turns');
    }

    public function mount()
    {
        $this->user_id = session('user_id');

        $this->getSpecialties(); 
        $this->loadTurns($this->user_id);
    }

    public function loadTurns($user_id){
        $this->turns = Turn::with(['doctor.specialty'])
                    ->where('user_id', $user_id)
                    ->whereDate('date', '>=', now()->toDateString())
                    ->orderBy('date', 'asc')
                    ->get(['date', 'time', 'doctor_id']);


        $this->turns = $this->turns->map(function ($turn) {
            return [
                'specialty' => $turn->doctor->specialty->specialty,
                'doctor_name' => $turn->doctor->user->name,
                'date' => $turn->date,
                'time' => $turn->time,
            ];
        });    

        $this->count_turns = $this->turns->count();


    }


    public function getSpecialties()
    {
        $this->specialties = Specialty::with('doctors')->get();
    }

    public function updatedSpecialtyName()
    {
        $this->getDoctors();
    }


    public function getDoctors()
    {
        if ($this->specialtyId) {
            $this->doctors = Doctor::where('specialty_id', $this->specialtyId)->get();
        } else {
            $this->doctors = []; 
        }
    }
   
}
