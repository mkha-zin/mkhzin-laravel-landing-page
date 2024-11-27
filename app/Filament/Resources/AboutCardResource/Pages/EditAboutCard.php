<?php

namespace App\Filament\Resources\AboutCardResource\Pages;

use App\Filament\Resources\AboutCardResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAboutCard extends EditRecord
{
    protected static string $resource = AboutCardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
