<?php

namespace App\Filament\Resources\HeaderResource\Pages;

use App\Filament\Resources\HeaderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHeaders extends ListRecords
{
    protected static string $resource = HeaderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
