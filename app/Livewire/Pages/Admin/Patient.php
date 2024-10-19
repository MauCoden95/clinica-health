<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Models\User;

class Patient extends Component
{
    public $patients;
    public $count_patients;

    protected $listeners = ['deleteConfirmed'];

    public function mount()
    {
        $this->loadPatients();
    }

    public function loadPatients()
    {
        $this->patients = User::with('roles')->whereHas('roles', function ($query) {
            $query->where('name', 'paciente');
        })->get();
        
        $this->count_patients = $this->patients->count();
    }

    public function render()
    {
        return view('livewire.pages.admin.patient');
    }

    public function deletePatient($patientId)
    {
        $patient = User::find($patientId);

        if ($patient) {
            $patient->removeRole('paciente');
            $patient->delete();

           
            $this->loadPatients();

         

            session()->flash('successDelete', 'Paciente eliminado exitosamente.');
        } else {
            session()->flash('error', 'No se pudo encontrar el paciente.');
            $this->dispatchBrowserEvent('sweet-alert', [
                'icon' => 'error',
                'title' => 'Error al eliminar paciente.'
            ]);
        }
    }

    public function deleteConfirmed($patientId)
    {
        $this->deletePatient($patientId);
    }
}
