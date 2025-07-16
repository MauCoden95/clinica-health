<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Models\Supplier;

class Suppliers extends Component
{
    public $suppliers;
    public $count_suppliers;
    public $name, $address, $phone, $email, $cuil;
    public $nameFilter = '';

    public function mount()
    {
        $this->getSuppliers();
    }

    public function render()
    {
        return view('livewire.pages.admin.suppliers');
    }

    public function getSuppliers()
    {
        $this->suppliers = Supplier::where('name', 'like', '%' . $this->nameFilter . '%')->get();
        $this->count_suppliers = Supplier::count();
    }

    public function updatedNameFilter()
    {
        $this->getSuppliers();
    }

    public function createSupplier()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:suppliers,email',
            'cuil' => 'required|string|max:20|unique:suppliers,cuil',
        ]);

        Supplier::create([
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'cuil' => $this->cuil,
        ]);

        $this->getSuppliers();
        $this->reset(['name', 'address', 'phone', 'email', 'cuil']);

        $this->dispatch('showAlert', 
        [
            'type' => 'success',
            'title' => '¡Éxito!',
            'text' => 'Proveedor creado correctamente'
        ]);
    }
}
