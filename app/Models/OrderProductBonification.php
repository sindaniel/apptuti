<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProductBonification extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_product_id',
        'bonification_id',
        'product_id',
        'quantity',
        'order_id',
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function bonification(){
        return $this->belongsTo(Bonification::class);
    }
}
