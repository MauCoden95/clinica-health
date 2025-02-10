<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Supplier;

class CreateSupplierForm extends Component
{
    public $name;
    public $address;
    public $phone;
    public $cuil;
    public $email;

    
    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:suppliers',
        'address' => 'required|string|max:255',
        'phone' => 'required|numeric|min:1000000',
        'email' => 'required|string|max:255'
    ];


    public function render()
    {
        return view('livewire.create-supplier-form');
    }

    public function create(){

        

        $this->validate();

        $supplier = new Supplier();

        $supplier->name = $this->name;
        $supplier->email = $this->email;
        $supplier->address = $this->address;
        $supplier->phone = $this->phone;
        $supplier->cuil = $this->cuil;
       

        $save = $supplier->save();

        $this->dispatch('supplierAdded');

        if($save){
            $this->dispatch('showAlert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'text' => 'Proveedor registrado correctamente'
            ]);
        }

        
    }


    
}
