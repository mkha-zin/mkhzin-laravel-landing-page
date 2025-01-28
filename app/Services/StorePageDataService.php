<?php

namespace App\Services;

use App\Models\AppScreen;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Feature;
use App\Models\StoreStep;
use App\Models\StoreText;
use Illuminate\Support\Facades\Cache;

class StorePageDataService
{
    public function getStorePageData(): array
    {
        return Cache::remember('store_page_data', 3600, function () {
            return [
                'brands' => Brand::query()->get(),
                'features' => Feature::query()->get(),
                'categories' => Category::query()->get(),
                'storetextwelcome' => StoreText::query()->where('key', 'welcome text')->first(),
                'storetextcategories' => StoreText::query()->where('key', 'categories text')->first(),
                'storetextdownload' => StoreText::query()->where('key', 'download text')->first(),
                'steps' => StoreStep::query()->orderBy('order', 'asc')->get(),
                'screens' => AppScreen::query()->get(),
            ];
        });
    }
}
