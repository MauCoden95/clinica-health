<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Repositories\PatientRepository;
use App\Traits\LogoutTrait;

class Patient extends Component
{
    use LogoutTrait;

    public $patients;
    public $count_patients;
    public $patientId;
    public $name;
    public $email;
    public $address;
    public $phone;
    public $dni;
    public $obra_social;
    public $dniFilter = '';
    protected $listeners = ['deleteConfirmed'];
    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'address' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'dni' => 'required|string|max:20|unique:users',
        'obra_social' => 'required|string|max:255'
    ];

    protected $patientRepo;

    public function __construct()
    {
        $this->patientRepo = new PatientRepository();
    }

    public function mount()
    {
        $this->loadPatients();
    }

    public function render()
    {
        $this->patients = $this->patientRepo->getAllPatients($this->dniFilter);
        return view('livewire.pages.admin.patient');
    }

    public function loadPatients()
    {
        $this->patients = $this->patientRepo->getAllPatients();
        $this->count_patients = $this->patients->count();
    }

    public function deletePatient($patientId)
    {
        if ($this->patientRepo->deletePatient($patientId)) {
            $this->loadPatients();
            session()->flash('successDelete', 'Paciente eliminado exitosamente.');
        } else {
            session()->flash('error', 'No se pudo encontrar el paciente.');
        }
    }

    public function deleteConfirmed($patientId)
    {
        $this->deletePatient($patientId);
    }

    public function register()
    {
        $this->validate();
        $this->patientRepo->createPatient([  
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'phone' => $this->phone,
            'dni' => $this->dni,
            'obra_social' => $this->obra_social,
        ]);

        $this->loadPatients();
        $this->dispatch('showAlert', ['type' => 'success', 'title' => '¡Éxito!', 'text' => 'Usuario registrado correctamente']);
        $this->reset(['name', 'email', 'address', 'phone', 'dni', 'obra_social']);
        session()->flash("success", "Usuario registrado correctamente");
    }

    public function editPatient()
    {
        if ($this->patientRepo->updatePatient($this->patientId, [
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'phone' => $this->phone,
            'dni' => $this->dni,
            'obra_social' => $this->obra_social,
        ])) {
            $this->dispatch('showAlert', ['type' => 'success', 'title' => '¡Éxito!', 'text' => 'Paciente actualizado correctamente']);
            $this->loadPatients();
            session()->flash('success', 'Paciente actualizado correctamente.');
        } else {
            session()->flash('error', 'No se pudo encontrar el paciente.');
        }
    }
}
