<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerReview extends Model
{
    protected $guarded = [];

    protected $with = [
        'branch'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
}
