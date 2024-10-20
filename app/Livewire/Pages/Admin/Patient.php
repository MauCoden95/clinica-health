<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Models\User;

class Patient extends Component
{
    public $patients;
    public $count_patients;

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



    

    public function mount()
    {
        $this->loadPatients();
    }






    public function render()
    {
        $filteredPatients = User::with('roles')
            ->whereHas('roles', function ($query) {
                $query->where('name', 'paciente');
            })
            ->when($this->dniFilter, function ($query) {
                return $query->where('dni', 'like', $this->dniFilter . '%');
            })
            ->get();

        $this->patients = $filteredPatients;

        return view('livewire.pages.admin.patient');
    }






    public function loadPatients()
    {
        $this->patients = User::with('roles')->whereHas('roles', function ($query) {
            $query->where('name', 'paciente');
        })->get();
        
        $this->count_patients = $this->patients->count();
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
        }
    }






    public function deleteConfirmed($patientId)
    {
        $this->deletePatient($patientId);
    }






    
    public function logout()
    {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->to('/');
    }





    public function register()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'phone' => $this->phone,
            'dni' => $this->dni,
            'obra_social' => $this->obra_social,
            'password' => bcrypt(env('DEFAULT_PASSWORD')),
        ]);

        if ($user) {
            $user->assignRole('paciente');

            $this->loadPatients();

            
            $this->dispatch('showAlert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'text' => 'Usuario registrado correctamente'
            ]);

           
            $this->reset(['name', 'email', 'address', 'phone', 'dni', 'obra_social']);

            session()->flash("success","Usuario registrado correctamente");    
        }

        
    }




    public function editPatient($patientId)
    {
        return Redirect::route('admin.edit-patient', ['id' => $patientId]);
    }
}
