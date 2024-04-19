<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'banner',
        'slug',
        'minimum_purchase',
        'active',
        'discount',
        'vendor_type',
    ];

    public function brands(){
        return $this->hasMany(Brand::class);
    }


    
}
