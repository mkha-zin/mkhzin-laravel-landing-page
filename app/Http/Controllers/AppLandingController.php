<?php

namespace App\Http\Controllers;

use App\Services\StorePageDataService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class AppLandingController extends Controller
{
    protected StorePageDataService $storePageDataService;

    public function __construct(StorePageDataService $storePageDataService)
    {
        $this->storePageDataService = $storePageDataService;
    }

    public function viewStore(): Factory|View|Application|\Illuminate\View\View
    {
        $data = $this->storePageDataService->getStorePageData();

        return view('store', $data);
    }


}
