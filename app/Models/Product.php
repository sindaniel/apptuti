<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends  Model
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
        'brand_id',
        'variation_id',
        'is_combined',
        'parent_id'
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
        return $this->belongsToMany(Product::class, 'product_related', 'product_id', 'product_related_id')->orderBy('name');
    }

    
    public function tax(){
        return $this->belongsTo(Tax::class);
    }

    public function variation(){
        return $this->belongsTo(Variation::class);
    }


    public function combinations(){
        return $this->belongsToMany(Product::class, 'product_combination', 'product_id', 'parent_id')->orderBy('name');
    }


    public function items(){
        return $this->belongsToMany(VariationItem::class, 'product_item_variation', 'product_id', 'variation_item_id')->withPivot(["price", "enabled"]);
    }


    public function images(){
        return $this->hasMany(ProductImage::class);
    }

}
