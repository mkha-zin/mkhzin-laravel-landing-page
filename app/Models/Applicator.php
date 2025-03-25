<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applicator extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'social_profiles' => 'array',
        ];
    }
}
