<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'discount',
        'variation_item_id',
        'is_bonification'
    ];



    public function product(){
        return $this->belongsTo(Product::class);
    }
}
