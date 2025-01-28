<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Hero extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_ar',
        'title_en',
        'image'
    ];

    protected static function booted()
    {
        static::saved(fn() => Cache::forget('index_data'));
        static::deleted(fn() => Cache::forget('index_data'));
    }
}
