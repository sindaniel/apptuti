<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'banner',
        'description',
        'slug',
        'delivery_days',
        'active'
    ];

    public function vendors(){
        return $this->belongsToMany(Vendor::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
