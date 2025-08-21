<?php

namespace App\Traits;

use App\Models\User;

trait LogoutTrait
{
    public function logout()
    {
        $userId = auth()->id(); 
        
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        

        $this->updateLatestLogin($userId);
      
        return redirect()->to('/');
    }


    public function updateLatestLogin($user_id) {
        $update = User::find($user_id);
        $update->date = now()->format('Y-m-d');
        $update->time = now()->timezone('America/Argentina/Buenos_Aires')->format('H:i:s');
        $update->save();
    }

   
}