<?php

namespace App\Livewire\Pages\Admin\Statistics;

use Livewire\Component;
use App\Models\Turn;
use Carbon\Carbon;

class TurnsStatistics extends Component
{
    public function render()
    {
        return view('livewire.pages.admin.statistics.turns-statistics');
    }

    public function count_turns_by_day(){
        $today = Carbon::today();

        $turnsToday = Turn::whereDate('date', $today)
        ->where('status', 'unavailable')
        ->count();

        return $turnsToday;
    }

    public function count_turns_by_month(){
        $today = Carbon::today();

        $turnsMonth = Turn::whereMonth('date', $today)
        ->where('status', 'unavailable')
        ->count();

        return $turnsMonth;
    }

    public function count_turns_by_week(){
        $today = Carbon::today();

        $turnsWeek = Turn::whereRaw('WEEK(`date`, 1) = ?', [$today->weekOfYear])
        ->whereYear('date', $today->year)
        ->where('status', 'unavailable')
        ->count();


        return $turnsWeek;
    }

    public function turns_by_specialty(){
        $turnsBySpecialty = Turn::with('doctor.specialty')
        ->where('status', 'unavailable')
        ->get()
        ->groupBy(function ($turn) {
            return $turn->doctor->specialty->specialty ?? 'Sin especialidad';
        })
        ->map(function ($group) {
            return $group->count();
        });

        return $turnsBySpecialty;
    }


    public function turns_by_doctor(){
        $turnsByDoctor = Turn::with('doctor')
        ->where('status', 'unavailable')
        ->get()
        ->groupBy(function ($turn) {
            return $turn->doctor->name ?? 'Sin doctor';
        })
        ->map(function ($group) {
            return $group->count();
        });

        return $turnsByDoctor;
    }

}
