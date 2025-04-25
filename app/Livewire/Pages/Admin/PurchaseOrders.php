<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Models\Product;

class PurchaseOrders extends Component
{
    public $productsToReplenished = [];

    
    public function mount(){
        $this->getProductsToReplenished();
    }

    public function render()
    {
        return view('livewire.pages.admin.purchase-orders');
    }



    public function getProductsToReplenished(){
        $products = Product::whereColumn('stock','<=','stock_reposition')->get();

        $this->productsToReplenished = $products;
    }
}
