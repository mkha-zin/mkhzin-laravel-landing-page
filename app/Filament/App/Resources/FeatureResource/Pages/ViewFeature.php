<?php

namespace App\Filament\App\Resources\FeatureResource\Pages;

use App\Filament\App\Resources\FeatureResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewFeature extends ViewRecord
{
    protected static string $resource = FeatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
