<?php

namespace App\Filament\App\Resources\StoreStepResource\Pages;

use App\Filament\App\Resources\StoreStepResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStoreSteps extends ListRecords
{
    protected static string $resource = StoreStepResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
