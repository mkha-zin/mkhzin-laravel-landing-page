<?php

namespace App\Models;

use Database\Factories\AppScreenFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class AppScreen extends Model
{
    /** @use HasFactory<AppScreenFactory> */
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        static::saved(fn() => Cache::forget('store_page_data'));
        static::deleted(fn() => Cache::forget('store_page_data'));
    }

}
