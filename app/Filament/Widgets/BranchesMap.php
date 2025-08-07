<?php

namespace App\Filament\Widgets;

use App\Models\Branch;
use Illuminate\Support\Facades\App;
use Webbingbrasil\FilamentMaps\Actions;
use Webbingbrasil\FilamentMaps\Concerns\HasDarkModeTiles;
use Webbingbrasil\FilamentMaps\Marker;
use Webbingbrasil\FilamentMaps\Widgets\MapWidget;

class BranchesMap extends MapWidget
{
    use HasDarkModeTiles;

    protected int|string|array $columnSpan = 2;

    protected bool $hasBorder = false;


    public array $mapOptions = [
        'center' => ['lat' => 24.7136, 'lng' => 46.6753],
        'zoom' => 5,
    ];

    public function getMarkers(): array
    {
        $branches = Branch::all();
        $markers = [];

        if (!empty($branches)) {
            foreach ($branches as $branch) {
                $markers[] = Marker::make('pos' . $branch->id)
                    ->lat($branch->latitude)
                    ->lng($branch->longitude)
                    ->popup(
                        '
                        <div style="text-align: center; font-weight: bold; font-family: Noto Naskh Arabic, serif">
                            <strong style="color: darkred; margin-top: 5px">' . e(data_get($branch, App::currentLocale() === 'ar' ? 'name_ar' : 'name_en', '')) . '</strong>
                            <br>
                            <a href="tel:+966920011209">920011209</a>
                            <br>' .
                        (!empty($branch->map_link) ? '
                                <a style="color: darkred; border: 1px solid darkred; border-radius: 5px; padding: 5px; margin-top: 5px; display: inline-block"
                            href="' . e($branch->map_link) . '" target="_blank" >
                                ' . __('landing.View on Google Maps') . '
                            </a>' : '') . '
                        </div>');
            }
            return $markers;
        }

        return [];
    }

    public function getActions(): array
    {
        return [
            Actions\ZoomAction::make(),
            Actions\CenterMapAction::make()->zoom(3),
        ];
    }
}
