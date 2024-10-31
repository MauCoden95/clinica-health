<?php

namespace App\Livewire\Pages\Paciente;

use Livewire\Component;
use App\Models\Doctor;
use App\Models\Turn;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TurnsDoctor extends Component
{
    public $id;
    public $name;
    public $turns_availables;

    public function mount($id){
        $this->id = $id;

        $this->getDoctorName($this->id);
        $this->getTurnsAvailables($this->id);
    }

    public function render()
    {
        return view('livewire.pages.paciente.turns-doctor');
    }

    public function getDoctorName($id){
        $doctorName = Doctor::find($id)->user->name;

        $this->name = $doctorName;
    }

    public function getTurnsAvailables($id){
        $turns = DB::table('turns')
                ->select('date', 'time', 'status')
                ->where('status', 'available')
                ->where('doctor_id', $id)
                ->whereDate('date', '>=', Carbon::now()->toDateString()) 
                ->orderBy('date')
                ->get();

        $turns_group = $turns->groupBy('date');

        $this->turns_availables = $turns_group;
    }
}
