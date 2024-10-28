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
            $user = auth()->user();

           
            if (!auth()->user()->hasRole('admin') && !auth()->user()->hasRole('doctor')) {
                auth()->logout(); 
                $this->addError('email', 'Sólo profesionales pueden ingresar.'); 
                return; 
            }

            session()->regenerate();
            session(['user' => $user]);
            return redirect()->to('/dashboard');
        }
        
        $this->addError('email', 'Las credenciales proporcionadas no son correctas.');
    }

    
}
