<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

class ContactInfo extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected static function booted()
    {
        static::saved(fn() => Cache::forget('index_data'));
        static::deleted(fn() => Cache::forget('index_data'));
    }

    public function action(): BelongsTo
    {
        return $this->belongsTo(Action::class);
    }
}
