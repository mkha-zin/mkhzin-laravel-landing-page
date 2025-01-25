<?php

namespace App\Filament\App\Resources\AppScreenResource\Pages;

use App\Filament\App\Resources\AppScreenResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAppScreen extends ViewRecord
{
    protected static string $resource = AppScreenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
