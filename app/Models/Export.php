<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Export extends Model
{
    use HasFactory;

    protected $table = 'exports';

    // belong to user relation
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
