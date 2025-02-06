<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Supplier;

class SuppliersList extends Component
{
    public $suppliers;


    public function mount(){
        $this->loadSuppliers();
    }

    public function render()
    {
        return view('livewire.suppliers-list');
    }


    public function loadSuppliers(){
        $this->suppliers = Supplier::all();
    }
}
