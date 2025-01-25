<?php

namespace App\Filament\App\Resources\AppScreenResource\Pages;

use App\Filament\App\Resources\AppScreenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAppScreens extends ListRecords
{
    protected static string $resource = AppScreenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
