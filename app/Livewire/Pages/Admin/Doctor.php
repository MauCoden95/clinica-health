<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Models\Specialty;
use App\Models\User;

class Doctor extends Component
{
    public $doctors;
    public $count_doctors;
    public $specialties;


    public $name;
    public $email;
    public $address;
    public $phone;
    public $dni;
    public $obra_social;
    public $specialty_id;
    public $license;

    public $dniFilter = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'address' => 'required|string|max:255',
        'phone' => 'required|numeric|min:1000000',
        'dni' => 'required|numeric|min:10000000|unique:users',
        'license' => 'required|numeric|min:100000|unique:doctors',
    ];


   
    public function mount()
    {
        $this->loadDoctors();
        $this->getSpecialties(); 
    }

    public function render()
    {
        $filteredDoctors = \App\Models\Doctor::with(['user.roles', 'specialty'])
            ->whereHas('user.roles', function ($query) {
                $query->where('name', 'doctor');
            })
            ->when($this->dniFilter, function ($query) {
                return $query->whereHas('user', function ($query) {
                    $query->where('dni', 'like', $this->dniFilter . '%'); 
                });
            })
            ->get();

        $this->doctors = $filteredDoctors; 

        return view('livewire.pages.admin.doctor');
    }

    public function logout()
    {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->to('/');
    }


    public function loadDoctors()
    {
        $this->doctors = \App\Models\Doctor::with(['user.roles', 'specialty'])->whereHas('user.roles', function ($query) {
            $query->where('name', 'doctor');
        })->get();
        
        $this->count_doctors = $this->doctors->count();
    }

    public function getSpecialties(){
        $specialties = Specialty::all();

        $this->specialties = $specialties;
    }


    public function create_doctor()
    {
        $this->validate();

    
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'phone' => $this->phone,
            'dni' => $this->dni,
            'obra_social' => "-",
            'password' => bcrypt(env('DEFAULT_PASSWORD')),
        ]);

        if ($user) {
            $user->assignRole('doctor');

            $doctor =  \App\Models\Doctor::create([
                'specialty_id' => $this->specialty_id, 
                'user_id' => $user->id, 
                'license' => $this->license, 
            ]);



            $this->dispatch('showAlert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'text' => 'Doctor registrado correctamente'
            ]);

            $this->loadDoctors();
           
            //$this->reset(['name', 'email', 'address', 'phone', 'dni', 'obra_social']);

            session()->flash("success","Usuario registrado correctamente");    
        }

       
    }

}
