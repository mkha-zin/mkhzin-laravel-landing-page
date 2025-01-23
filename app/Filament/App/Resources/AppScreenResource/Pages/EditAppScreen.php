<?php

namespace App\Filament\App\Resources\AppScreenResource\Pages;

use App\Filament\App\Resources\AppScreenResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAppScreen extends EditRecord
{
    protected static string $resource = AppScreenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
