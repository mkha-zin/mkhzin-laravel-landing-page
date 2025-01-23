<?php

namespace App\Filament\App\Resources\StoreTextResource\Pages;

use App\Filament\App\Resources\StoreTextResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStoreText extends EditRecord
{
    protected static string $resource = StoreTextResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
