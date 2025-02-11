<?php

namespace App\Repositories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    public function getPatientsWithRepeatedTurns()
    {
        $startDate = Carbon::now()->startOfMonth()->subMonths(3);
        $endDate = Carbon::now()->endOfMonth();

        return User::select('users.name', DB::raw('count(*) as total'))
            ->join('turns', 'users.id', '=', 'turns.user_id')
            ->whereBetween('turns.date', [$startDate, $endDate])
            ->groupBy('users.name')
            ->having('total', '>', 1)
            ->get();
    }
}
