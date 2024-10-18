<?php

namespace App\Livewire;

use Livewire\Component;

class BaseComponent extends Component
{
    public function render()
    {
        return view('livewire.base-component');
    }

    public function logout()
    {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->to('/');
    }
}
