<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Models\Turn;
use Carbon\Carbon;
use App\Traits\LogoutTrait;

class Calendar extends Component
{
    use LogoutTrait;

    public $events = [];
    public $turns = [];
    public $selectedDate;

    public function mount()
    {
        $this->loadEvents();
    }

    public function loadEvents()
    {
        $this->events = Turn::with(['user', 'doctor.user', 'doctor.specialty'])
                            ->where('status', 'unavailable')
                            ->get()
                            ->map(function ($turn) {
                                return [
                                    'name_patient' => $turn->user->name,
                                    'name_doctor' => $turn->doctor->user->name,
                                    'specialty' => $turn->doctor->specialty->specialty,
                                    'date' => $turn->date,
                                    'time' => $turn->time,
                                ];
                            });
    
    }


    public function showTurns($date)
    {
        $this->selectedDate = $date->format('Y-m-d');
        $this->turns = Turn::with(['user', 'doctor.specialty'])
            ->whereDate('date', $this->selectedDate)
            ->where('status', 'unavailable')
            ->get();

        
        $this->emit('turnsUpdated', $this->turns);
    }

    public function render()
    {
        return view('livewire.pages.admin.calendar', [
            'turns' => $this->turns,
        ]);
    }
}
