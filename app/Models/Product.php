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
        return $this->belongsToMany(Product::class, 'product_combination', 'parent_id', 'product_id')
            ->orderBy('name')
            ->withPivot(["price", "variation_item_id"]);
    }


    public function items(){
        return $this->belongsToMany(VariationItem::class, 'product_item_variation', 'product_id', 'variation_item_id')
            ->withPivot(["price", "enabled"]);
    }


    public function images(){
        return $this->hasMany(ProductImage::class);
    }


    public function bonifications(){
        return $this->belongsToMany(Bonification::class);
    }

    public function getFinalPriceAttribute(){
       

        $discount = $this->discount;
        $discount_on  = 'Producto';


        if($this->brand){
            if($this->brand->discount > $discount){
                $discount = $this->brand->discount;
                $discount_on  = 'Marca';
            }
        }
 
        if($this->brand->vendors?->first()){
            if($this->brand->vendors->first()->discount > $discount){
                $discount = $this->brand->vendors->first()->discount;
                $discount_on  = 'Vendor';
            }
        }   

        

        if($this->bonifications->count()){
            $discount_on  = false;
            $discount = 0;
        }

        $price = $this->price;

        $variation = $this->items?->first();
        if($this->items?->first()){
           $price = $variation->pivot->price;
        }


        return [
            'old'=>$price,
            'price'=>($price - ($price * $discount / 100)),
            'totalDiscount'=>($price * $discount / 100),
            'discount'=>$discount,
            'discount_on'=>$discount_on,
        ];
    }

}
