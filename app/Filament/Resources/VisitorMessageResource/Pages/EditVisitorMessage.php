<?php

namespace App\Filament\Resources\VisitorMessageResource\Pages;

use App\Filament\Resources\VisitorMessageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVisitorMessage extends EditRecord
{
    protected static string $resource = VisitorMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
