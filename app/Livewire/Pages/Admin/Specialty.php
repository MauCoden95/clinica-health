<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Traits\LogoutTrait;

class Specialty extends Component 
{
    use LogoutTrait;

    public $specialty;
    public $specialties;
    public $count_specialties;


    protected $listeners = ['deleteConfirmed'];

    protected $rules = [
        'specialty' => 'required|string|max:255',
    ];

    public function mount()
    {
        $this->loadSpecialties();
    }

    public function render()
    {
        return view('livewire.pages.admin.specialty');
    }

    public function loadSpecialties()
    {
        $this->specialties = \App\Models\Specialty::all();
        $this->count_specialties = $this->specialties->count();
    }


    public function create(){
        $this->validate();

        $specialty = \App\Models\Specialty::create([
            'specialty' => $this->specialty
        ]);

        if ($specialty) {
            $this->dispatch('showAlert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'text' => 'Especialidad registrada correctamente'
            ]);


            $this->loadSpecialties();
        }
    }


    public function deleteSpecialty($id){
        $specialty = \App\Models\Specialty::find($id);

        if ($specialty) {
            $delete = $specialty->delete();

            $this->loadSpecialties();
        }
    }

    public function deleteConfirmed($specialtyId)
    {
        $this->deleteSpecialty($specialtyId);
    }

}
