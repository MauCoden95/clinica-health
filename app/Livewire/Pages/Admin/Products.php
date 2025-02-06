<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Traits\LogoutTrait;
use App\Models\Product;


class Products extends Component
{
    use LogoutTrait;

    public $products;
    public $count_products;
    public $showProductsReposition = false;

    public function mount(){
        $this->loadProducts();
    }

    public function render()
    {
        $this->loadProducts();

        return view('livewire.pages.admin.products');
    }


    public function loadProducts(){
        $this->products = Product::all();
        $this->count_products = count($this->products);
    }


    public function showProductsToReposition(){
        if ($this->showProductsReposition) {            
            $this->products = Product::whereColumn('stock', '<=', 'stock_reposition')->get();            
        } else {            
            $this->products = Product::all();
        }
        
    }
  
}
