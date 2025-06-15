<?php

namespace App\Services;

use App\Models\About;
use App\Models\AboutCard;
use App\Models\Branch;
use App\Models\City;
use App\Models\ContactImage;
use App\Models\ContactInfo;
use App\Models\Fleet;
use App\Models\Hero;
use App\Models\Offer;
use App\Models\OurValue;
use App\Models\Section;
use App\Models\SocialLink;
use App\Models\Storage;
use App\Models\VisionAndGoal;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class DataFetcherService
{
    public function fetchData(): array
    {
        return Cache::remember('index_data', 3600, function () {
            return [
                'heroes' => Hero::query()->get(),
                'ourValues' => OurValue::query()->get(),
                'about' => About::query()->first(),
                'aboutCards' => AboutCard::query()->get(),
                'departments' => Section::query()->get(),
                'vision' => VisionAndGoal::getData('vision'),
                'goals' => VisionAndGoal::getData('goals'),
                'storage' => Storage::query()->first(),
                'fleet' => Fleet::query()->first(),
                'contactInfos' => ContactInfo::query()->get(),
                'contact_first_image' => ContactImage::query()->first(),
                'contact_second_image' => ContactImage::query()->orderBy('id', 'desc')->first(),
                'socialLinks' => SocialLink::query()->get(),
            ];
        });
    }

    public function getActiveOffers($city = null)
    {
        $query = Offer::select('offers.*')
            /*->where('offers.end_date', '>=', date('Y-m-d'))*/
            ->where('offers.is_active', 1)
            ->join('branches', 'branches.id', '=', 'offers.branch_id')
            ->orderBy('offers.end_date', 'desc');

        if ($city && $city !== 'all') {
            $query->where('branches.city_id', $city);
        }

        return $query->get();
    }

    public function getCities(): Collection
    {
        return City::all();
    }

    public function getBranches(): Collection
    {
        return Branch::all();
    }
}
