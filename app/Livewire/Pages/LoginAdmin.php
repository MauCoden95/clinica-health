<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class LoginAdmin extends Component
{
    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];


    public function render()
    {
        return view('livewire.pages.login-admin');
    }
    
            
    public function login()
    {
        $this->validate();

        if (auth()->attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->regenerate();
            $user = auth()->user();
            session(['user' => $user]);
            return redirect()->to('/dashboard');
        }
        
        

        $this->addError('email', 'Las credenciales proporcionadas no son correctas.');
    }

    
}
