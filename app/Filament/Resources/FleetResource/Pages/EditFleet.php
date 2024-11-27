<?php

namespace App\Filament\Resources\FleetResource\Pages;

use App\Filament\Resources\FleetResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFleet extends EditRecord
{
    protected static string $resource = FleetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
