<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    public function collection()
    {
        return User::with('role')->select('name', 'email', 'address', 'phone', 'dni', 'obra_social', 'password')->get();
    }

    public function map($user): array
    {
        return [
            $user->name,
            $user->email,
            $user->address,
            $user->phone,
            $user->dni,
            $user->obra_social,
            $user->password,
            optional($user->role)->role_name ?? 'Sin rol',
        ];
    }

}

