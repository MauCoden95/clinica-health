<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\EmailPasswordRecovery;

class PasswordRecovery extends Component
{
    public $email;

    public function render()
    {
        return view('livewire.pages.password-recovery');
    }

    public function sendMail(){
        if ($this->email == '') {
            $this->dispatch('showAlert', [
                'type' => 'error',
                'title' => '¡Error!',
                'text' => 'Campo vacío'
            ]);

            return;
        }

        $token = bin2hex(random_bytes(16));
        $resetUrl = url('http://localhost:8000/cambiar-contraseña/' . $token);
        $emailSent  = Mail::to($this->email)->send(new EmailPasswordRecovery($resetUrl));

        if ($emailSent) {
            
            DB::table('password_reset_tokens')->insert([
                'email' => $this->email,
                'token' => $token,
                'created_at' => now()->setTimezone('America/Argentina/Buenos_Aires'),
            ]);

            

            $this->dispatch('showAlert', [
                'type' => 'success',
                'title' => '¡Correo enviado!',
                'text' => 'Revise su bandeja de entrada'
            ]);
        } 
    }
}
