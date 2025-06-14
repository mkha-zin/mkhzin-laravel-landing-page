<?php

namespace App\Models;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    /** @use HasFactory<PostFactory> */
    use HasFactory;

    protected $guarded = [];

    public static function getLast3Posts()
    {
        return Post::where('status', 1)->orderBy('created_at', 'desc')->limit(3)->get();
    }

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }
}
