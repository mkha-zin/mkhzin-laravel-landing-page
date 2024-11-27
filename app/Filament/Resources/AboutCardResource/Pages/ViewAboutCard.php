<?php

namespace App\Filament\Resources\AboutCardResource\Pages;

use App\Filament\Resources\AboutCardResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAboutCard extends ViewRecord
{
    protected static string $resource = AboutCardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
