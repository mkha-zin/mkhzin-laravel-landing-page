<?php

namespace App\Filament\Resources\ContactImageResource\Pages;

use App\Filament\Resources\ContactImageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContactImages extends ListRecords
{
    protected static string $resource = ContactImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
