<?php

namespace App\Traits;

use App\Models\PurchaseOrderProduct;
use App\Models\PurchaseOrder;
use App\Models\Product;

trait SavePurchaseOrderProductTrait
{
    public function savePurchaseOrderProducts($purchaseOrder, $productsData)
    {
       
        foreach ($productsData as $productData) {
            $product = Product::where('name', $productData['product_name'])->first();
            
            if ($product) {
                PurchaseOrderProduct::create([
                    'purchase_order_id' => $purchaseOrder->id, 
                    'product_id' => $product->id,
                    'unit_price' => $productData['unit_price'],
                    'quantity' => $productData['quantity'],
                ]);
            }
        }
    }
}