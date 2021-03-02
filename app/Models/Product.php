<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function services()
    {
        return $this->belongsTo(Service::class, 'provider_id', 'provider_id');
    }
}
