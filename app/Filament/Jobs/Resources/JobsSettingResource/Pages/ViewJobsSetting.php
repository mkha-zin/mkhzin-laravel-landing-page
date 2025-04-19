<?php

namespace App\Filament\Jobs\Resources\JobsSettingResource\Pages;

use App\Filament\Jobs\Resources\JobsSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewJobsSetting extends ViewRecord
{
    protected static string $resource = JobsSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
