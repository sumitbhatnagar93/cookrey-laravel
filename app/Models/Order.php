<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function subscription()
    {
        return $this->belongsTo(UserSubscription::class, 'subId', 'id');
    }
}
