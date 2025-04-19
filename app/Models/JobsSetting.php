<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobsSetting extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = ['id', 'created_at', 'updated_at'];
}
