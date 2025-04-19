<?php

namespace App\Filament\Jobs\Resources\JobsSettingResource\Pages;

use App\Filament\Jobs\Resources\JobsSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJobsSettings extends ListRecords
{
    protected static string $resource = JobsSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
