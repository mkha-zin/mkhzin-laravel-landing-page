<?php

namespace App\Filament\Jobs\Resources\JobsSettingResource\Pages;

use App\Filament\Jobs\Resources\JobsSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJobsSetting extends EditRecord
{
    protected static string $resource = JobsSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
