<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Livewire\BaseComponent;
use App\Models\User;

class Patient extends BaseComponent
{
    public $patients;
    public $count_patients;

    public function mount()
    {
        $patients = $this->patients = User::with('roles')->whereHas('roles', function($query) {
            $query->where('name', 'paciente');
        })->get();      
        
        $this->count_patients = $this->patients->count();
    }

    public function render()
    {
        return view('livewire.pages.admin.patient');
    }
}
