<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function usersFeedback(): HasMany
    {
        return $this->hasMany(UsersFeedback::class, 'vendor_id', 'provider_id');
    }
    public function avgRating()
    {
        return $this->usersFeedback()
            ->selectRaw('avg(feedback_rating) as rating, vendor_id')
            ->groupBy('vendor_id');
    }

    public function servicesProduct(): HasMany
    {
        return $this->hasMany(Tiffin::class, 'vendor_id', 'provider_id');
    }

}
