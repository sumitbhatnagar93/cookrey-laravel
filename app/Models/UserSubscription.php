<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function order(){
        return $this->hasOne(Order::class,'subId','id');
    }

    public function product(){
        return $this->belongsTo(Tiffin::class, 'productId','id');
    }
}
