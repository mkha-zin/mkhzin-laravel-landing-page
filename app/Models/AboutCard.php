<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class AboutCard extends Model
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

}
