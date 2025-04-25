<?php

namespace App\Livewire\Pages\Admin;

use App\Models\Supplier;
use App\Models\Product;
use Livewire\Component;
use App\Traits\LogoutTrait;
use App\Repositories\ProductRepository;
use App\Repositories\SupplierRepository;

class Products extends Component
{
    use LogoutTrait;

    public $productId;
    public $products;
    public $count_products;
    public $showProductsReposition = false;

    public $name;
    public $supplierId;
    public $description;
    public $price;
    public $stock;
    public $stock_reposition;

    public $productsBySupplier;

    public $suppliers;

    public $nameFilter = '';
    public $countProductsReposition;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'price' => 'required|numeric',
        'stock' => 'required|numeric',
        'stock_reposition' => 'required|numeric',
    ];

    protected $listeners = [
        'productDeleted' => 'loadProducts',
        'supplierAdded' => 'getSuppliers', 
    ];

    protected $productRepository;
    protected $supplierRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
        $this->supplierRepository = new SupplierRepository();
    }

    public function mount()
    {
        $this->countProductsReposition = count($this->productRepository->getProductsToReposition());
        if ($this->countProductsReposition >= 1) {
            $this->dispatch('showAlert', [
                'type' => 'info',
                'title' => 'Aviso',
                'text' => 'Hay productos que necesitan reposición'
            ]);
        }

        
        $this->loadProducts();
        $this->getSuppliers();
        $this->productsBySupplier = [];
        
    }

    public function render()
    {
        $this->getProductsBySupplier($this->supplierId);



        return view('livewire.pages.admin.products', [
            'products' => $this->productRepository->getAll($this->nameFilter)
        ]);
    }


    public function loadProducts()
    {
        $this->products = $this->productRepository->getAll($this->nameFilter);
        $this->count_products = count($this->products);
    }

    public function showProductsToReposition()
    {
        $this->products = $this->showProductsReposition
            ? $this->productRepository->getProductsToReposition()
            : $this->productRepository->getAll($this->nameFilter);
    }


    public function create()
    {
        $this->validate();


        $create = $this->productRepository->create([
            'name' => $this->name,
            'supplier_id' => $this->supplierId,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'stock_reposition' => $this->stock_reposition
        ]);



        if ($create) {
            $this->dispatch('showAlert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'text' => 'Producto creado correctamente'
            ]);

            $this->reset(['name', 'supplierId', 'description', 'price', 'stock', 'stock_reposition']);

            $this->loadProducts();
        } else {
            $this->dispatch('showAlert', [
                'type' => 'error',
                'title' => 'Error!',
                'text' => 'Hubo un error'
            ]);
        }
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

    public function getSuppliers()
    {
        $this->suppliers = $this->supplierRepository->getAll();
    }

    public function getProductsBySupplier($supplierId)
    {
        if ($supplierId) {
            $this->productsBySupplier = $this->productRepository->productsBySupplier($supplierId);
        } else {
            $this->productsBySupplier = [];
        }
    }



    public function edit()
    {
        $this->validate();


        $update = $this->productRepository->update($this->productId, [
            'name' => $this->name,
            'supplier_id' => $this->supplierId,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'stock_reposition' => $this->stock_reposition
        ]);

        if ($update) {
            $this->loadProducts();

            $this->dispatch('showAlert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'text' => 'Producto editado correctamente'
            ]);
        }
    }

    public function updatedNameFilter()
    {
        $this->loadProducts();
    }

   
}
