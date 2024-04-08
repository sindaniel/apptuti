<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'user_id',
        'total',
        'discount',
        'status_id'
    ];


    const STATUS_PENDING = 0;
    const STATUS_PROCESED = 1;
    const STATUS_ERROR = 2;
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function products(){
        return $this->hasMany(OrderProduct::class);
       // return $this->belongsToMany(Product::class)->withPivot(["quantity","price", "discount", "variation_id", 'is_bonification']);
    }


    public function bonifications()
    {
        return $this->hasMany(OrderProductBonification::class);
    }



}
