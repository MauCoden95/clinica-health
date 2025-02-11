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

    public function getProductsToReposition()
    {
        return Product::whereColumn('stock', '<=', 'stock_reposition')->get();
    }

    public function delete($id)
    {
        $product = Product::find($id);
        return $product ? $product->delete() : false;
    }
}
