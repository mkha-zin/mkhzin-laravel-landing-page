<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $locale = $request->header('Accept-Language', app()->getLocale());

        return [
            'id' => $this->id,
            'title' => $locale === 'ar' ? $this->title_ar : $this->title_en,
            'article' => $locale === 'ar' ? $this->article_ar : $this->article_en,
            'image' => asset('storage/' . $this->image),
            'tag' => [
                'id' => $this->tag?->id,
                'name' => $locale === 'ar' ? $this->tag?->tag_ar : $this->tag?->tag_en,
            ],
            'created_at' => $this->created_at->toDateString(),
        ];
    }
}
