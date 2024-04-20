<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'business_name', 'read'];

    public function scopeUnRead($query)
    {
        return $query->where('read', false);
    }

    //get total row unread
    public function scopeTotalUnRead()
    {
        return $this->unRead()->count();
    }

    
}
