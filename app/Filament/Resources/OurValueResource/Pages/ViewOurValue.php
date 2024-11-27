<?php

namespace App\Filament\Resources\OurValueResource\Pages;

use App\Filament\Resources\OurValueResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewOurValue extends ViewRecord
{
    protected static string $resource = OurValueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
