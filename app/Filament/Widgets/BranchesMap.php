<?php

namespace App\Filament\Widgets;

use App\Models\Branch;
use Webbingbrasil\FilamentMaps\Actions;
use Webbingbrasil\FilamentMaps\Concerns\HasDarkModeTiles;
use Webbingbrasil\FilamentMaps\Marker;
use Webbingbrasil\FilamentMaps\Widgets\MapWidget;

class BranchesMap extends MapWidget
{
    use HasDarkModeTiles;
    protected int | string | array $columnSpan = 2;

    protected bool $hasBorder = false;

    protected function setUp(): void
    {
        $this
            ->rounded();

    }

    public function getMarkers(): array
    {
        $branches = Branch::all();
        $markers = [];

        if ( !empty($branches) ) {
            foreach ($branches as $branch) {
                $markers[] = Marker::make('pos' . $branch->id)
                    ->lat($branch->latitude)
                    ->lng($branch->longitude)
                    ->popup($branch->name);
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
