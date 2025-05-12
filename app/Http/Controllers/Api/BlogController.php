<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\TagResource;
use App\Models\Post;
use App\Models\Tag;
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

    public function show($id)
    {
        $post = Post::with('tag')->findOrFail($id);
        return new PostResource($post);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $posts = Post::where('status', 'active')
            ->where(function ($q) use ($query) {
                $q->where('title_ar', 'like', "%{$query}%")
                    ->orWhere('title_en', 'like', "%{$query}%")
                    ->orWhere('article_ar', 'like', "%{$query}%")
                    ->orWhere('article_en', 'like', "%{$query}%");
            })
            ->with('tag')
            ->paginate($request->per_page ?? 5);

        if ($posts->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No posts found',
            ], 404);
        }

        return PostResource::collection($posts)->additional(['status' => true, 'message' => 'success']);
    }

    public function getTags()
    {
        $tags = Tag::withCount('posts')->where('status', 'active')->get();
        return TagResource::collection($tags);
    }

}
