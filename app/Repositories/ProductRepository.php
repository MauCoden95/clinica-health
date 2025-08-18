<?php



namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function getAll($nameFilter = null, $perPage = 10)
    {
        $query = Product::query();

        if ($nameFilter) {
            $query->where('name', 'like', '%' . $nameFilter . '%');
        }

        return $query->paginate($perPage);
    }


    public function getById($id)
    {
        return Product::find($id);
    }

    public function create($data)
    {
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

    public function productsBySupplier($supplierId)
    {
        $products = Product::where('supplier_id', $supplierId)->get();

        return $products;
    }

    public function update($id, array $data)
    {
        $product = $this->getById($id);


        return $product ? $product->update($data) : false;
    }

    public function getAllPaginated($nameFilter = null, $supplierId = null, $perPage = 10)
    {
        return Product::when($nameFilter, function($query) use ($nameFilter) {
                $query->where('name', 'like', '%' . $nameFilter . '%');
            })
            ->when($supplierId, function($query) use ($supplierId) {
                $query->where('supplier_id', $supplierId);
            })
            ->paginate($perPage);
    }
}
