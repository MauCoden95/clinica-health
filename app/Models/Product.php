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
}
