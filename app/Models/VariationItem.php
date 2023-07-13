<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariationItem extends Model
{
    use HasFactory;

    protected $appends = ['price_label'];

    protected $fillable = [ 'name'];

    public function variation(){
        return $this->belongsTo(Variation::class);
    }


    public function getPriceLabelAttribute(){
        return;
        return $this->variation->name.': '.$this->name.' -  $'.number_format($this->pivot->price);
    }

    
    
}
