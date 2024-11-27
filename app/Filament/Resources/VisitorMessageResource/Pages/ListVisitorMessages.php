<?php

namespace App\Filament\Resources\VisitorMessageResource\Pages;

use App\Filament\Resources\VisitorMessageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVisitorMessages extends ListRecords
{
    protected static string $resource = VisitorMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
