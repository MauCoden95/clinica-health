<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Traits\LogoutTrait;
use App\Repositories\ProductRepository;

class Products extends Component
{
    use LogoutTrait;

    public $productId;
    public $products;
    public $count_products;
    public $showProductsReposition = false;

    protected $listeners = ['productDeleted' => 'loadProducts'];

    protected $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }

    public function mount()
    {
        $this->loadProducts();
    }

    public function render()
    {
        return view('livewire.pages.admin.products');
    }

    public function loadProducts()
    {
        $this->products = $this->productRepository->getAll();
        $this->count_products = count($this->products);
    }

    public function showProductsToReposition()
    {
        $this->products = $this->showProductsReposition
            ? $this->productRepository->getProductsToReposition()
            : $this->productRepository->getAll();
    }

    public function deleteProduct()
    {
        $deleted = $this->productRepository->delete($this->productId);

        if ($deleted) {
            $this->dispatch('productDeleted');
            $this->dispatch('showAlert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'text' => 'Producto eliminado correctamente'
            ]);
        }
    }
}
