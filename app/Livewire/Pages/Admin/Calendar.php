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
        $this->events = Turn::with(['user', 'doctor.specialty'])
            ->get()
            ->map(function ($turn) {
                return [
                    'id' => $turn->id,
                    'title' => $turn->user ? $turn->user->name : 'Sin paciente', 
                    'start' => Carbon::parse($turn->date . ' ' . $turn->time)->toIso8601String(), 
                    'doctor' => $turn->doctor ? $turn->doctor->user->name : 'Sin médico', 
                    'specialty' => $turn->doctor && $turn->doctor->specialty ? $turn->doctor->specialty->specialty : 'Sin especialidad', // Manejar caso nulo
                ];
            })
            ->toArray();
    }


    public function showTurns($date)
    {
        $this->selectedDate = $date->format('Y-m-d');
        $this->turns = Turn::with(['user', 'doctor.specialty'])
            ->whereDate('date', $this->selectedDate)
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
