<?php

namespace App\Filament\App\Resources\StoreStepResource\Pages;

use App\Filament\App\Resources\StoreStepResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewStoreStep extends ViewRecord
{
    protected static string $resource = StoreStepResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
