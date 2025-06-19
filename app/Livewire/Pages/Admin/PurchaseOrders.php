<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Models\Product;
use App\Models\Supplier;

class PurchaseOrders extends Component
{
    public $productsToReplenished = [];
    public $groupedBySupplier = [];


    public function mount()
    {

        $products = Product::whereColumn('stock', '<=', 'stock_reposition')->get();


        $this->groupedBySupplier =   Supplier::whereHas('products', function ($query) {
            $query->whereColumn('stock_reposition', '>=', 'stock');
        })->with(['products' => function ($query) {
            $query->whereColumn('stock_reposition', '>=', 'stock');
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
}
