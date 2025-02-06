<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AccountVerifyController extends Controller
{
    public function verifyEmail($token)
    {
        $user = User::where('verification_token', $token)->first();

        if ($user) {
            $user->verify = 1;
            $user->verification_token = null;
            $user->save();

            return redirect('/verified-account')->with('message', 'Cuenta verificada con éxito');
        }

        return redirect('/login')->with('error', 'Token de verificación no válido');
    }
}
