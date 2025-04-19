<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    protected $guarded = [];

    protected $casts = [
        'answers' => 'array',
    ];

    public function job(): BelongsTo
    {
        return $this->belongsTo(Career::class);
    }
}
