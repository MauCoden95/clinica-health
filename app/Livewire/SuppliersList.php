<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Supplier;

class SuppliersList extends Component
{
    public $suppliers;
    public $count_suppliers;


    protected $listeners = [
        'supplierAdded' => 'loadSuppliers',
        'providerDeleted' => 'loadSuppliers'
    ];


    public function mount(){
        $this->loadSuppliers();
    }

    public function render()
    {
        return view('livewire.suppliers-list');
    }

    

    public function loadSuppliers(){
        $this->suppliers = Supplier::all();
        $this->count_suppliers = Supplier::count();
    }

    public function deleteSupplier($id){
        $supplier = Supplier::find($id);

        $this->dispatch('providerDeleted');

        if($supplier){
            $supplier->delete();
            $this->dispatch('showAlert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'text' => 'Proveedor eliminado correctamente'
            ]);
        }

        
    }
}
