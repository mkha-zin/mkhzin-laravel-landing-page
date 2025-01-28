<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        static::saved(fn() => Cache::forget('store_page_data'));
        static::deleted(fn() => Cache::forget('store_page_data'));
    }
}
