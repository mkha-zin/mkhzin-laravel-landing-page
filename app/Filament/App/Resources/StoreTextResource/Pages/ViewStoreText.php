<?php

namespace App\Filament\App\Resources\StoreTextResource\Pages;

use App\Filament\App\Resources\StoreTextResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewStoreText extends ViewRecord
{
    protected static string $resource = StoreTextResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
