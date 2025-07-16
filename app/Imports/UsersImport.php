<?php
namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class UsersImport implements ToModel
{
    public function model(array $row)
    {
        $user = User::create([
            'name'     => $row[0],
            'email'    => $row[1],
            'address' =>$row[2],
            'phone' => $row[3], 
            'dni' => $row[4],
            'obra_social' => $row[5],            
            'password' => $row[6]
        ]);

        $user->assignRole($row[7]);

        return $user;
    }
}
