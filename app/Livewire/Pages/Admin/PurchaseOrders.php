<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\PurchaseOrder;
use Carbon\Carbon;
use App\Traits\SavePurchaseOrderProductTrait;

class PurchaseOrders extends Component
{
    use SavePurchaseOrderProductTrait;

    public $productsToReplenished = [];
    public $groupedBySupplier = [];

    public $product_name = [];
    public $product_price = [];
    public $product_stock_reposition = [];



    public function mount()
    {
        $products = Product::whereColumn('stock', '<=', 'stock_reposition')->get();

        foreach ($products as $product) {
            $this->product_name[$product->id] = $product->name;
            $this->product_price[$product->id] = $product->price;
            $this->product_stock_reposition[$product->id] = $product->stock_reposition;
        }

        $this->groupedBySupplier = Supplier::whereHas('products', function ($query) {
            $query->whereColumn('stock', '<=', 'stock_reposition');
        })->with(['products' => function ($query) {
            $query->whereColumn('stock', '<=', 'stock_reposition');
        }])->get();


        $this->getProductsToReplenished();
    }


    public function render()
    {
        return view('livewire.pages.admin.purchase-orders');
    }



    public function getProductsToReplenished()
    {
        $products = Product::whereColumn('stock', '<=', 'stock_reposition')->get();

        $this->productsToReplenished = $products;
    }


    public function generatePurchaseOrder($supplierId)
    {
        $total = 0;
        $productsToOrderData = [];

        $supplier = Supplier::with(['products' => function ($query) {
            $query->whereColumn('stock', '<=', 'stock_reposition');
        }])->findOrFail($supplierId);


        foreach ($supplier->products as $product) {
            $productId = $product->id;

            $quantity =  $this->product_stock_reposition[$productId];
            $price =  $this->product_price[$productId];

            $productsToOrderData[] = [
                'product_id' => $productId,
                'quantity' => $quantity,
                'unit_price' => $price,
            ];

            $total += $quantity * $price;
        }



        $purchaseOrder = $this->purchaseOrderSave($supplierId, $total);

        $this->savePurchaseOrderProducts($purchaseOrder, $productsToOrderData);

        $this->dispatch('showAlert', [
            'type' => 'success',
            'title' => '¡Éxito!',
            'text' => 'Orden #' . $purchaseOrder->id . ' creada correctamente',
        ]);
    }


    public function purchaseOrderSave($supplierId, $total)
    {

        $now = Carbon::now()->setTimezone('America/Argentina/Buenos_Aires');

        $purchaseOrder = PurchaseOrder::create([
            'supplier_id' => $supplierId,
            'date' => $now->toDateString(),
            'time' => $now->format('H:i'),
            'total' => $total,
        ]);

        return $purchaseOrder;
    }
}
