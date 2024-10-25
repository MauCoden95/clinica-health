<?php

namespace App\Traits;

trait LogoutTrait
{
    public function logout()
    {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->to('/');
    }
}