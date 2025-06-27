<?php

namespace App\Traits;

use App\Models\PurchaseOrderProduct;
use App\Models\PurchaseOrder;

trait SavePurchaseOrderProductTrait
{
    public function savePurchaseOrderProducts(PurchaseOrder $purchaseOrder, array $productsData)
    {
       
        foreach ($productsData as $productData) {
            PurchaseOrderProduct::create([
                'purchase_order_id' => $purchaseOrder->id, 
                'product_id' => $productData['product_id'],
                'unit_price' => $productData['unit_price'],
                'quantity' => $productData['quantity'],
            ]);
        }
    }
}