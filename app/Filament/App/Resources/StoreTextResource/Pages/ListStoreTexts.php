<?php

namespace App\Filament\App\Resources\StoreTextResource\Pages;

use App\Filament\App\Resources\StoreTextResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStoreTexts extends ListRecords
{
    protected static string $resource = StoreTextResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
