<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Supplier;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderProduct;
use App\Repositories\SupplierRepository;
use App\Traits\GeneratePurchaseOrderPdf;
use Illuminate\Support\Facades\DB;

class ShowPurchaseOrdersBySupplier extends Component
{
    use GeneratePurchaseOrderPdf;
    public $suppliers = [];
    public $supplierId;
    public $purchaseOrders = [];
    protected $supplierRepository;
    public $supplier;

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




    public function downloadPurchaseOrder($purchaseOrderId, $total)
    {
        $purchaseOrder = $this->getPurchaseOrder($purchaseOrderId);
        $supplier = $this->getSupplier($purchaseOrder->supplier_id);
        $products = $this->getProductsByPurchaseOrder($purchaseOrderId);

        
        $this->supplier = Supplier::find($this->supplierId);
        
        return $this->generatePurchaseOrderPdf($purchaseOrder, $products, $supplier, $total);
    }


    public function getSupplier($supplierId)
    {
        $supplier = Supplier::find($supplierId);

        return $supplier;
    }


    public function getPurchaseOrder($purchaseOrderId)
    {
        $purchaseOrder = PurchaseOrder::find($purchaseOrderId);

        return $purchaseOrder;
    }

    public function getProductsByPurchaseOrder($purchaseOrderId){
        $purchaseOrder = PurchaseOrder::with('products')
            ->find($purchaseOrderId);
        
        if (!$purchaseOrder) {
            return collect([]);
        }

        return $purchaseOrder->products->map(function ($product) {
            return [
                'product_name' => $product->name,
                'quantity' => $product->pivot->quantity,
                'unit_price' => $product->pivot->unit_price
            ];
        });
    }
    
}
