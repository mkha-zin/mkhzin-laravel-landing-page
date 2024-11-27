<?php

namespace App\Filament\Resources\AboutCardResource\Pages;

use App\Filament\Resources\AboutCardResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAboutCards extends ListRecords
{
    protected static string $resource = AboutCardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
