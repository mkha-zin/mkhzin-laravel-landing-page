<?php

namespace App\Filament\Resources\ContactImageResource\Pages;

use App\Filament\Resources\ContactImageResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewContactImage extends ViewRecord
{
    protected static string $resource = ContactImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
