<?php

namespace App\Filament\App\Resources\StoreStepResource\Pages;

use App\Filament\App\Resources\StoreStepResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStoreStep extends EditRecord
{
    protected static string $resource = StoreStepResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
