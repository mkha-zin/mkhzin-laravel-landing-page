<?php

namespace App\Filament\Resources\FleetResource\Pages;

use App\Filament\Resources\FleetResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewFleet extends ViewRecord
{
    protected static string $resource = FleetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
