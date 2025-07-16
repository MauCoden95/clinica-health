<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use App\Repositories\UserRepository;
use App\Traits\LogoutTrait;
use Illuminate\Support\Facades\Hash;

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
    public $email;
    public $address;
    public $phone;
    public $obra_social;
    public $dni;
    


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



    
    public function updatedUserFilter(){
        $this->getUsers();
    }

    public function createUser(){
        $user = $this->userRepository->create([
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'phone' => $this->phone,
            'obra_social' => $this->obra_social,
            'dni' => $this->dni,
            'password' => Hash::make(env('DEFAULT_PASSWORD')),
        ]);

        if($user){
            $user->assignRole($this->role_id);
            $this->getUsers();
            $this->dispatch('showAlert', 
            [
                'type' => 'success',
                'title' => '¡Éxito!',
                'text' => 'Usuario creado correctamente'
            ]);
            $this->reset(['name', 'email', 'address', 'phone', 'obra_social', 'dni', 'role_id']);
        }else{
            $this->dispatch('showAlert', 
            [
                'type' => 'error',
                'title' => '¡Error!',
                'text' => 'Error al crear el usuario'
            ]);
        }


        
      
      
      
      
    }
}
