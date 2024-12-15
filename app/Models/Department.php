<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Department extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'tags_ar' => 'array',
        'tags_en' => 'array',
    ];
}
