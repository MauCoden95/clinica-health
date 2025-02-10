<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Supplier;

class SuppliersList extends Component
{
    public $suppliers;
    public $supplierId;
    public $count_suppliers;
    public $name;
    public $address;
    public $email;
    public $phone;
    public $cuil;


    protected $listeners = [
        'deleteConfirmed' => 'deleteSupplier',
        'supplierAdded' => 'loadSuppliers',
        'providerDeleted' => 'loadSuppliers',
        'providerUpdated' => 'loadSuppliers'
    ];


    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:suppliers',
        'address' => 'required|string|max:255',
        'phone' => 'required|numeric|min:1000000',
        'email' => 'required|string|max:255'
    ];


    public function mount()
    {
        $this->loadSuppliers();
    }

    public function render()
    {
        return view('livewire.suppliers-list');
    }



    public function loadSuppliers()
    {
        $this->suppliers = Supplier::all();
        $this->count_suppliers = Supplier::count();
    }

    public function deleteSupplier()
    {
        $supplier = Supplier::find($this->supplierId);
        if ($supplier) {
            $supplier->delete();
            $this->dispatch('providerDeleted');
            $this->dispatch('showAlert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'text' => 'Proveedor eliminado correctamente'
            ]);
        }
    }



    public function editSupplier() {
        $supplier = Supplier::find($this->supplierId);
        
        if ($supplier) {
            $update = $supplier->update([
                'name' => $this->name,
                'email' => $this->email,
                'address' => $this->address,
                'phone' => $this->phone,
                'cuil' => $this->cuil
            ]);


            if ($update) {
                $this->dispatch('providerUpdated');
                $this->dispatch('showAlert', [
                    'type' => 'success',
                    'title' => '¡Éxito!',
                    'text' => 'Proveedor actualizado correctamente'
                ]);
            } else {
                $this->dispatch('showAlert', [
                    'type' => 'error',
                    'title' => '¡Error!',
                    'text' => 'No se pudo actualizar el proveedor'
                ]);
            }
        }
    }
}
