<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Feature extends Model
{
    /** @use HasFactory<\Database\Factories\FeatureFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::saved(fn() => Cache::forget('store_page_data'));
        static::deleted(fn() => Cache::forget('store_page_data'));
    }
}
