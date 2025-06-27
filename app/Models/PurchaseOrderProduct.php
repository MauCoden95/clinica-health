<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_order_id',
        'product_id',
        'unit_price',
        'quantity',
    ];


    public function products()
    {
        return $this->belongsToMany(Product::class, 'purchase_order_products')
                    ->withPivot('quantity', 'unit_price') 
                    ->withTimestamps(); 
    }
}
