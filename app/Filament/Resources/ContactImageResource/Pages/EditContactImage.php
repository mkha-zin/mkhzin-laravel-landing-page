<?php

namespace App\Filament\Resources\ContactImageResource\Pages;

use App\Filament\Resources\ContactImageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContactImage extends EditRecord
{
    protected static string $resource = ContactImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
