<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderProduct;
use App\Repositories\SupplierRepository;
use App\Traits\GeneratePurchaseOrderPdf;
use App\Traits\AddExpenseTrait;


class ShowPurchaseOrdersBySupplier extends Component
{
    use GeneratePurchaseOrderPdf, AddExpenseTrait;
    public $suppliers = [];
    public $supplierId;
    public $purchaseOrders = [];
    protected $supplierRepository;
    public $supplier;
    public $state = [];
    public $showOnlyPending = false;

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
        $query = PurchaseOrder::where('supplier_id', $this->supplierId)
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc');

        if ($this->showOnlyPending) {
            $query->where('state', 'Pendiente')->orWhere('state', 'Enviado');
        }

        $this->purchaseOrders = $query->get();
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




    public function getProductsByPurchaseOrder($purchaseOrderId)
    {
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



    public function updatedState()
    {
        foreach ($this->state as $id => $value) {
            if (!is_null($value)) {
                $this->setStatePurchaseOrder($id, $value);
            }
        }
    }

    public function setStatePurchaseOrder($id, $state)
    {
        $purchaseOrder = PurchaseOrder::find($id);


        if ($purchaseOrder) {


            $update = $purchaseOrder->update([
                'state' => $state
            ]);

            $this->dispatch('updateProductsToReplenished');


            if ($update && $state == 'Entregado') {
                $this->setStockProducts($purchaseOrder->id);
                $this->addExpense($purchaseOrder->total);


            }else if($update && $state == 'Cancelado'){
                $this->dispatch('showAlert', [
                    'type' => 'error',
                    'title' => 'Exito',
                    'text' => 'Orden de compra cancelada'
                ]);
            }
        }
    }


    public function setStockProducts($id){
        $purchaseOrderProducts = PurchaseOrderProduct::where('purchase_order_id','=', $id)->get();

        foreach ($purchaseOrderProducts as $purchaseOrderProduct) {
            $product = Product::find($purchaseOrderProduct->product_id);
            $update = $product->update([
                'stock' => $product->stock + $purchaseOrderProduct->quantity
            ]);


            if($update){
                $this->dispatch('showAlert', [
                    'type' => 'success',
                    'title' => 'Exito',
                    'text' => 'Stock actualizado exitosamente'
                ]);
            }
           
        }

       
    }



}
