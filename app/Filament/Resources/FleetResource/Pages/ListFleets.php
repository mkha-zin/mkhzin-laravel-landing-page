<?php

namespace App\Filament\Resources\FleetResource\Pages;

use App\Filament\Resources\FleetResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFleets extends ListRecords
{
    protected static string $resource = FleetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
