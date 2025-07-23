<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Traits\LogoutTrait;

class Stadistics extends Component
{
    use LogoutTrait;

    public function render()
    {
        return view('livewire.pages.admin.stadistics');
    }
}
