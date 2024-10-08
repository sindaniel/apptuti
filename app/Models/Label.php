<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    use HasFactory;

    protected $fillable = [ 'name', 'slug', 'description', 'active', 'image'];


    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
