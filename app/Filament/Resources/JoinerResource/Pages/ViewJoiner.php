<?php

namespace App\Filament\Resources\JoinerResource\Pages;

use App\Filament\Resources\JoinerResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewJoiner extends ViewRecord
{
    protected static string $resource = JoinerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
