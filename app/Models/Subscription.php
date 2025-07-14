<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'is_active',
        'unsubscribed_at',
    ];

    public static function changeStatus(Subscription $record)
    {
        if ($record->is_active) {
            $record->is_active = false;
            $record->unsubscribed_at = now();
        } else {
            $record->is_active = true;
            $record->unsubscribed_at = null;
        }
        $record->save();
    }
}
