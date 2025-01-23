<?php

namespace App\Http\Controllers;

use App\Models\AppScreen;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Feature;
use App\Models\StoreStep;
use App\Models\StoreText;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class AppLandingController extends Controller
{
    public function viewStore(): Factory|View|Application|\Illuminate\View\View
    {
        $data['brands'] = Brand::query()->get();
        $data['features'] = Feature::query()->get();
        $data['categories'] = Category::query()->get();
        $data['storetextwelcome'] = StoreText::query()->where('key', 'welcome text')->first();
        $data['storetextcategories'] = StoreText::query()->where('key', 'categories text')->first();
        $data['storetextdownload'] = StoreText::query()->where('key', 'download text')->first();
        $data['steps'] = StoreStep::query()->orderBy('order', 'asc')->get();
        $data['screens'] = AppScreen::query()->get();

        return view('store', $data);
    }


}
