<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Livewire\BaseComponent;
use App\Traits\LogoutTrait;

class Dashboard extends Component
{
    use LogoutTrait;

    public function render()
    {
        return view('livewire.pages.dashboard');
    }
    
    
   
}
