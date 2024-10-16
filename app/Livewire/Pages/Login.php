<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function render()
    {
        return view('livewire.pages.login');
    }
   

    public function login()
    {
        $this->validate();

        if (auth()->attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->regenerate();
            $user = auth()->user();
            session(['user' => $user]);
            return $this->redirect('/dashboard', navigate: true);
        }
        
        

        $this->addError('email', 'Las credenciales proporcionadas no son correctas.');
    }
}
