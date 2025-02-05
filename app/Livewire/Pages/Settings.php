<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\User;
use App\Traits\LogoutTrait;
use Illuminate\Support\Facades\Hash;

class Settings extends Component
{
    use LogoutTrait;

    public $user;
    public $user_id;
    public $email;
    public $address;
    public $phone;
    public $obra_social;
    public $password;
    public $password_confirm;
    public $is_logged_out;
    public $psw_delete;
    public $psw_delete_confirm;

    public $rules = [
        'email' => 'required|email',
        'address' => 'required',
        'phone' => 'required',
        'obra_social' => 'required',
        'password' => 'required|min:8',
        'password_confirm' => 'required|same:password',
    ];


    public function mount()
    {
        $this->user = User::find(session('user')->id);
        $this->user_id = session('user')->id;
        $this->email = session('user')->email;
        $this->address = session('user')->address;
        $this->phone = session('user')->phone;
        $this->obra_social = session('user')->obra_social;
    }

    public function render()
    {
        return view('livewire.pages.settings');
    }


    public function updateUser()
    {
        $user = User::find($this->user_id);


        if ($this->password != $this->password_confirm) {
            $this->dispatch('showAlert', [
                'type' => 'error',
                'title' => '¡Error!',
                'text' => 'Las contraseñas no coinciden'
            ]);

            return;
        }


        if ($this->email == '' || $this->address == '' || $this->phone == '' || $this->obra_social == '' || $this->password == '' ||  $this->password_confirm == '') {
            $this->dispatch('showAlert', [
                'type' => 'error',
                'title' => '¡Error!',
                'text' => 'Campos vacíos'
            ]);

            return;
        }


        $update = $user->update([
            'email' => $this->email,
            'address' => $this->address,
            'phone' => $this->phone,
            'obra_social' => $this->obra_social,
            'password' => bcrypt($this->password)
        ]);

        if ($update) {
            $this->dispatch('showAlert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'text' => 'Paciente actualizado correctamente'
            ]);
        } else {
            $this->dispatch('showAlert', [
                'type' => 'error',
                'title' => '¡Error!',
                'text' => 'Error al actualizar el paciente'
            ]);
        }
    }




    public function deleteAccount()
    {
        $user = User::find($this->user_id);


        if ($this->psw_delete == '' || $this->psw_delete_confirm == '') {
            $this->dispatch('showAlert', [
                'type' => 'error',
                'title' => '¡Error!',
                'text' => 'Campos vacíos'
            ]);

            return;
        }

        if ($this->psw_delete != $this->psw_delete_confirm) {
            $this->dispatch('showAlert', [
                'type' => 'error',
                'title' => '¡Error!',
                'text' => 'Las contraseñas no coinciden'
            ]);

            return;
        }


        $verify = $this->passwordVerify($this->psw_delete,$user->password);

        if ($verify) {
            $this->dispatch('showAlert', [
                'type' => 'success',
                'title' => '¡Cuenta eliminada!',
                'text' => 'Se cerrara sesion'
            ]);

           $delete = $user->delete();

            if ($delete) {
                $this->dispatch('showAlert', [
                    'type' => 'success',
                    'title' => '¡Éxito!',
                    'text' => 'Has eliminado tu cuenta, se cerrara sesion'
                ]);

                return redirect()->route('index');
            } 
        }

       
    }


    public function passwordVerify($psw,$user_psw){
        if (!Hash::check($psw, $user_psw)) {
            return false;
        }else{
            return true;
        }
    }
}
