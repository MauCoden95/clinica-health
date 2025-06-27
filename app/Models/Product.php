<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'supplier_id',
        'description',
        'price',
        'stock',
        'stock_reposition'
    ];


    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /* public function purchaseOrders()
    {
        return $this->belongsToMany(PurchaseOrder::class)
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
*/

    public function purchaseOrders()
    {
        return $this->belongsToMany(PurchaseOrder::class, 'purchase_order_products')
            ->withPivot('quantity', 'unit_price')
            ->withTimestamps(); 
    }
}
