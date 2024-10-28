<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Specialty;
use App\Models\Doctor;
use App\Traits\LogoutTrait;

class Turns extends Component
{
    use LogoutTrait;

    public $specialties;
    public $specialtyId;
    public $doctors;

    public function render()
    {
        $this->getDoctors();         

        return view('livewire.pages.turns');
    }


    public function mount()
    {
        $this->getSpecialties(); 
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
