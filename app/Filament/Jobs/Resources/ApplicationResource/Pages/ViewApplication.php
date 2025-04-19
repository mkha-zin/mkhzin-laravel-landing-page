<?php

namespace App\Filament\Jobs\Resources\ApplicationResource\Pages;

use App\Filament\Jobs\Resources\ApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewApplication extends ViewRecord
{
    protected static string $resource = ApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
