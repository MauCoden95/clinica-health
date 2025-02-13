<?php



namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function getAll()
    {
        return Product::all();
    }

    public function getById($id)
    {
        return Product::find($id);
    }

    public function create($data){
        $product = Product::create($data);

        return $product;
    }

    public function getProductsToReposition()
    {
        return Product::whereColumn('stock', '<=', 'stock_reposition')->get();
    }

    public function delete($id)
    {
        $product = Product::find($id);
        return $product ? $product->delete() : false;
    }

    public function productsBySupplier($supplierId){
        $products = Product::where('supplier_id',$supplierId)->get();

        return $products;
    }

    public function update($id,array $data)
    {
        $product = $this->getById($id);
               

        return $product ? $product->update($data): false;

    }
}
