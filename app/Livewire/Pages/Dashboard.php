<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Livewire\BaseComponent;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.pages.dashboard');
    }
    
    
    public function logout()
    {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->to('/');
    }
}
