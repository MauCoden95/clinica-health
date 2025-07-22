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


    public function getAll($name = '')
    {
        return User::query()
            ->when(trim($name), function ($query) use ($name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->get();
    }

    public function create($data)
    {
        return User::create($data);
    }

    public function getUserById($id)
    {
        return User::find($id);
    }

    public function update($id, $data)
    {
        return User::find($id)->update($data);
    }
}
