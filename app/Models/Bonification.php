<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bonification extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'buy',
        'get',
    ];


    public function products(){
        return $this->belongsToMany(Product::class)->orderBy('name');
    }

}
