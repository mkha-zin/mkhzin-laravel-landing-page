<?php

namespace App\Filament\Resources\OurValueResource\Pages;

use App\Filament\Resources\OurValueResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOurValues extends ListRecords
{
    protected static string $resource = OurValueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
