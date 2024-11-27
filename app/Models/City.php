<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_en',
    ];

    protected $hidden=[
        'created_at',
        'updated_at'
    ];

    public function branch():HasMany
    {
        return $this->hasMany(Branch::class);
    }
}
