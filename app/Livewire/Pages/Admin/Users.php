<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use App\Repositories\UserRepository;
use App\Traits\LogoutTrait;
use Illuminate\Support\Facades\Hash;
use App\Models\Doctor;

class Users extends Component
{
    use LogoutTrait;
    public $users;
    public $count_users;
    public $userFilter = '';

    protected $userRepository;

    public $roles;
    public $role_id;

    public $name;
    public $email = '';
    public $address = '';
    public $phone = '';
    public $obra_social = '';
    public $dni = '';
    public $user_id;

    protected $listeners = ['deleteConfirmed'];



    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function mount()
    {
        $this->roles = Role::all();
        $this->getUsers();
    }

    public function render()
    {
        return view('livewire.pages.admin.users');
    }


    public function getUsers()
    {
        $this->users = $this->userRepository->getAll($this->userFilter);
        $this->count_users = User::count();
    }




    public function updatedUserFilter()
    {
        $this->getUsers();
    }

    public function createUser()
    {
        $role = $this->role_id;

        if ($this->name == '' || $this->email == '' || $this->address == '' || $this->phone == '' || $this->obra_social == '' || $this->dni == '') {
            $this->dispatch(
                'showAlert',
                [
                    'type' => 'error',
                    'title' => '¡Error!',
                    'text' => 'Todos los campos son obligatorios'
                ]
            );

            return;
        }

        $user = $this->userRepository->create([
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'phone' => $this->phone,
            'obra_social' => $this->obra_social,
            'dni' => $this->dni,
            'password' => Hash::make(env('DEFAULT_PASSWORD')),
        ]);



        if ($user) {
            $user->assignRole($this->role_id);
            $this->getUsers();
            $this->dispatch(
                'showAlert',
                [
                    'type' => 'success',
                    'title' => '¡Éxito!',
                    'text' => 'Usuario creado correctamente'
                ]
            );
            $this->reset(['name', 'email', 'address', 'phone', 'obra_social', 'dni', 'role_id']);



            if ($role == 'doctor') {
                $doctor = Doctor::create([
                    'specialty_id' => 3,
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'address' => $user->address,
                    'phone' => $user->phone,
                    'license' => 000000
                ]);
            }
        } else {
            $this->dispatch(
                'showAlert',
                [
                    'type' => 'error',
                    'title' => '¡Error!',
                    'text' => 'Error al crear el usuario'
                ]
            );
        }
    }



   

    

    public function updateUser($userId, $name, $email, $address, $phone, $dni, $obra_social)
    {
        $user = $this->userRepository->getUserById($userId);

        if (empty($name) || empty($email) || empty($address) || empty($phone) || empty($obra_social) || empty($dni)) {
            $this->dispatch(
                'showAlert',
                [
                    'type' => 'error',
                    'title' => '¡Error!',
                    'text' => 'Todos los campos son obligatorios'
                ]
            );
            return;
        }

        try {
            $this->userRepository->update($userId, [
                'name' => $name,
                'email' => $email,
                'address' => $address,
                'phone' => $phone,
                'obra_social' => $obra_social,
                'dni' => $dni,
            ]);

            $user->syncRoles([$this->role_id]);
            $this->getUsers();
            $this->dispatch(
                'showAlert',
                [
                    'type' => 'success',
                    'title' => '¡Éxito!',
                    'text' => 'Usuario editado correctamente'
                ]
            );
        } catch (\Throwable $th) {
            $this->dispatch(
                'showAlert',
                [
                    'type' => 'error',
                    'title' => '¡Error!',
                    'text' => 'Error al editar el usuario'
                ]
            );
        }
    }


    public function deleteConfirmed($id){
        dd($id);
        $this->userRepository->delete($this->user_id);
        $this->getUsers();
        $this->dispatch(
            'showAlert',
            [
                'type' => 'success',
                'title' => '¡Éxito!',
                'text' => 'Usuario eliminado correctamente'
            ]
        );
    }
}
