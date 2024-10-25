<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Models\Doctor;
use Illuminate\Validation\Rule;
use App\Traits\LogoutTrait;


class EditDoctor extends Component
{
    use LogoutTrait;

    public $doctor;

    public $specialty_id;
    public $user_id;
    public $license;


    public $name;
    public $email;
    public $address;
    public $phone;
    public $dni;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'address' => 'required|string|max:255',
        'phone' => 'required|numeric|min:10000000',
        'dni' => 'required|numeric|min:10000000',
        'license' => 'required|numeric|min:10000'
    ];
    
    

    public function render()
    {
        return view('livewire.pages.admin.edit-doctor');
    }

    public function mount($id){
        $this->doctor = Doctor::find($id);
        $this->name = $this->doctor->user->name;
        $this->email = $this->doctor->user->email;
        $this->address = $this->doctor->user->address;
        $this->phone = $this->doctor->user->phone;
        $this->dni = $this->doctor->user->dni;
        $this->license = $this->doctor->license;
    }

    

    public function editDoctor()
    {
        try {
            $validatedData = $this->validate([
                'name' => 'required|string|max:255',
                'email' => ['required', 'email', Rule::unique('users')->ignore($this->doctor->user->id)],
                'address' => 'required|string|max:255',
                'phone' => 'required|numeric|min:10000000',
                'dni' => ['required', 'numeric', Rule::unique('users')->ignore($this->doctor->user->id)],
                'license' => 'required|numeric|min:10000'
            ]);

            $update = $this->doctor->user->update($validatedData);

            if ($update) {
                $this->doctor->update([
                    'license' => $this->license,
                ]);
    
                $this->dispatch('showAlert', [
                    'type' => 'success',
                    'title' => '¡Éxito!',
                    'text' => 'Doctor actualizado correctamente'
                ]);
            }

          
        } catch (\Exception $e) {
            $this->dispatch('showAlert', [
                'type' => 'error',
                'title' => 'Error',
                'text' => 'Ocurrió un error al actualizar el doctor'
            ]);
        }
    }
}
