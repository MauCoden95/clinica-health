<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\User;

class Register extends Component
{
    public function render()
    {
        return view('livewire.pages.register');
    }

    public $name;
    public $email;
    public $address;
    public $phone;
    public $dni;
    public $obra_social;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'address' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'dni' => 'required|string|max:20|unique:users',
        'obra_social' => 'required|string|max:255',
        'password' => 'required|string|min:8|confirmed'
    ];

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
            'password' => bcrypt($this->password),
        ]);

        $user->assignRole('paciente');

        session()->flash("success","Usuario registrado correctamente");
    }
}
