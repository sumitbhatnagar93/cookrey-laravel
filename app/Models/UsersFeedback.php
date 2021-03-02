<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersFeedback extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users_feedback';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'feedback_id';

    protected $guarded = [
        'feedback_id', 'created_at', 'updated_at'
    ];

    public function services()
    {
        return $this->belongsTo(Service::class, 'vendor_id', 'provider_id');
    }
}
