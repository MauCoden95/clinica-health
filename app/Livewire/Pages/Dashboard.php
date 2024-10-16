<?php

namespace App\Livewire\Pages;

use Livewire\Component;

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
        return $this->redirect('/', navigate: true);
    }
}
