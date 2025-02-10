<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Supplier;
use Illuminate\Database\QueryException;
use App\Traits\DuplicateField;

class CreateSupplierForm extends Component
{
    use DuplicateField;

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

    public function create()
    {
        $this->validate();

        try {
            $supplier = new Supplier();
            $supplier->name = $this->name;
            $supplier->email = $this->email;
            $supplier->address = $this->address;
            $supplier->phone = $this->phone;
            $supplier->cuil = $this->cuil;

            $supplier->save();

            $this->dispatch('supplierAdded');

            $this->dispatch('showAlert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'text' => 'Proveedor registrado correctamente'
            ]);


            $this->reset();
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                $duplicateField = $this->getDuplicateField($e->getMessage());

                $this->dispatch('showAlert', [
                    'type' => 'error',
                    'title' => 'Error',
                    'text' => "El {$duplicateField} ya está registrado. Intenta con otro."
                ]);
            } else {
                $this->dispatch('showAlert', [
                    'type' => 'error',
                    'title' => 'Error',
                    'text' => 'Ocurrió un error inesperado. Inténtalo de nuevo.'
                ]);
            }
        }
    }


    
}
