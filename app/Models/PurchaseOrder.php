<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\PurchaseOrderProduct;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',  
        'date',
        'time',
        'total',
    ];
        

    public function post(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'purchase_order_products')
                    ->withPivot(['quantity', 'unit_price'])
                    ->withTimestamps();
    }
    
}
