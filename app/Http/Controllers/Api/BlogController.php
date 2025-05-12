<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $locale = $request->header('Accept-Language', app()->getLocale());

        $posts = Post::with('tag')
            ->where('status', 'active')
            ->when($request->has('tag_id'), fn($query) => $query->where('tag_id', $request->tag_id)
            )
            ->latest()
            ->paginate($request->per_page ?? 5);


        $return = PostResource::collection($posts)->additional(['status' => true, 'message' => 'success']);
        $empty = response()->json([
            'status' => false,
            'message' => 'No posts found',
        ], 404);

        if ($return->isEmpty()) {
            return $empty;
        }
        return $return;
    }

}
