<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Traits\LogoutTrait;
use App\Repositories\SpecialtyRepository;

class Specialty extends Component 
{
    use LogoutTrait;

    public $specialtyId;
    public $specialty;
    public $specialties;
    public $count_specialties;

    protected $listeners = ['deleteConfirmed'];

    protected $rules = [
        'specialty' => 'required|string|max:255',
    ];

    protected $specialtyRepo;

    public function boot(SpecialtyRepository $specialtyRepo)
    {
        $this->specialtyRepo = $specialtyRepo;
    }

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
        $this->specialties = $this->specialtyRepo->getAll();
        $this->count_specialties = $this->specialties->count();
    }

    public function create()
    {
        $this->validate();

        if ($this->specialtyRepo->create(['specialty' => $this->specialty])) {
            $this->dispatch('showAlert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'text' => 'Especialidad registrada correctamente'
            ]);

            $this->loadSpecialties();
        }
    }

    public function deleteSpecialty($id)
    {
        if ($this->specialtyRepo->delete($id)) {
            $this->loadSpecialties();
        }
    }

    public function deleteConfirmed($specialtyId)
    {
        $this->deleteSpecialty($specialtyId);
    }

    public function editSpecialty()
    {
        $this->validate([
            'specialty' => 'required|string',
        ]);

        if ($this->specialtyRepo->update($this->specialtyId, ['specialty' => $this->specialty])) {
            $this->dispatch('showAlert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'text' => 'Especialidad actualizada correctamente'
            ]);

            $this->loadSpecialties();
        }
    }
}
