<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ChangePassword extends Component
{
    public $password;
    public $password_confirmation;
    public $token;



    public function mount($token){
        $this->token = $token;
    }


    public function render()
    {
        return view('livewire.pages.change-password');
    }





    public function changePasswordLost(){
            $isValid = $this->isPasswordValid($this->password, $this->password_confirmation);

            if ($isValid) {
                $email = DB::table('password_reset_tokens')->where('token', $this->token)->value('email');

                $user = User::where('email', $email)->first();

                $user->password = bcrypt($this->password);
                $update = $user->save();

                if ($update) {
                    $this->dispatch('showAlert', [
                        'type' => 'success',
                        'title' => '¡Contraseña cambiada!',
                        'text' => 'Su contraseña ha sido cambiada exitosamente'
                    ]);  
                    
                    DB::table('password_reset_tokens')->where('token', $this->token)->delete();
                }
               
            }


    }






    public function isPasswordValid($psw, $psw_confirmation){
        if ($psw == '' || $psw_confirmation == '') {
            $this->dispatch('showAlert', [
                'type' => 'error',
                'title' => '¡Error!',
                'text' => 'Campos vacíos'
            ]);

            return false;
        }

        if (strlen($psw) < 8 || strlen($psw_confirmation) < 8) {
            $this->dispatch('showAlert', [
                'type' => 'error',
                'title' => '¡Error!',
                'text' => 'La contraseña debe tener al menos 8 caracteres'
            ]);

            return false;
        }

        if ($psw != $psw_confirmation) {
            $this->dispatch('showAlert', [
                'type' => 'error',
                'title' => '¡Error!',
                'text' => 'Las contraseñas no coinciden',
            ]);

            return false;
        }

        return true;
    }
}
