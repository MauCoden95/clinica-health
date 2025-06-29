<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Supplier;
use App\Models\PurchaseOrder;
use App\Repositories\SupplierRepository;


class ShowPurchaseOrdersBySupplier extends Component
{
    public $suppliers = [];
    public $supplierId;
    public $purchaseOrders = [];
    protected $supplierRepository;

    public function __construct()
    {
        $this->supplierRepository = new SupplierRepository();
    }

    public function mount()
    {
        $this->suppliers = $this->supplierRepository->getAll();
    }

    public function render()
    {
        $this->updateSupplierId();

        return view('livewire.show-purchase-orders-by-supplier');
    }

    public function updateSupplierId()
    {
        $this->purchaseOrders = PurchaseOrder::where('supplier_id', $this->supplierId)->get();


    }
}
