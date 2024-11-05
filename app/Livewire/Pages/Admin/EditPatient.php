<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use App\Traits\LogoutTrait;


class EditPatient extends Component
{
    use LogoutTrait;

    public $patient;
    public $patientId;
    public $name;
    public $email;
    public $address;
    public $phone;
    public $dni;
    public $obra_social;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'address' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'dni' => 'required|string|max:20',
        'obra_social' => 'required|string|max:255',
    ];

    public function mount($id)
    {
        $this->patientId = $id;
        $this->patient = User::findOrFail($id);
        $this->name = $this->patient->name;
        $this->email = $this->patient->email;
        $this->address = $this->patient->address;
        $this->phone = $this->patient->phone;
        $this->dni = $this->patient->dni;
        $this->obra_social = $this->patient->obra_social;
    }

    public function render()
    {
        return view('livewire.pages.admin.edit-patient');
    }

    public function editPatient()
    {
      
        try {
            $validatedData = $this->validate([
                'name' => 'required|string|max:255',
                'email' => ['required', 'email', Rule::unique('users')->ignore($this->patientId)],
                'address' => 'required|string|max:255',
                'phone' => 'required|numeric|max:9999999999', 
                'dni' => ['required', 'numeric', Rule::unique('users')->ignore($this->patientId)],
                'obra_social' => 'required|string|max:255',
            ]);

            $patient = User::find($this->patientId);

            if ($patient) {
                $update = $patient->update($validatedData);

                if ($update) {
                    $this->dispatch('showAlert', [
                        'type' => 'success',
                        'title' => '¡Éxito!',
                        'text' => 'Paciente actualizado correctamente'
                    ]);
                }

               
            } else {
                $this->dispatch('showAlert', [
                    'type' => 'error',
                    'title' => 'Error',
                    'text' => 'Paciente no encontrado'
                ]);
            }
        }catch (\Exception $e) {
            $this->dispatch('showAlert', [
                'type' => 'error',
                'title' => 'Error',
                'text' => 'Ocurrió un error al actualizar el paciente'
            ]);
        }
        
    }
}