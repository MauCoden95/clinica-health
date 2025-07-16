<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductsExport implements FromCollection
{
    public function collection()
    {
        return Product::select('name', 'description', 'price', 'stock', 'stock_reposition')->get();
    }

    public function map($product): array
    {
        return [
            $product->name,
            $product->description,
            $product->price,
            $product->stock,
            $product->stock_reposition,
        ];
    }
}
