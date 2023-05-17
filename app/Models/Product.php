<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'short_description',
        'sku',
        'slug',
        'active',
        'price',
        'delivery_days',
        'discount',
        'quantity_min',
        'quantity_max',
        'step',
        'tax_id',
        'brand_id'
    ];

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function labels(){
        return $this->belongsToMany(Label::class);
    }

    public function related(){
        return $this->belongsToMany(Product::class, 'product_related', 'product_id', 'product_related_id');
    }

    
    public function tax(){
        return $this->belongsTo(Tax::class);
    }
}
