<?php

namespace App\Filament\Jobs\Resources\ApplicationResource\Pages;

use App\Filament\Jobs\Resources\ApplicationResource;
use App\Filament\Jobs\Widgets\JobsStatsOverview;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListApplications extends ListRecords
{
    protected static string $resource = ApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [JobsStatsOverview::class];
    }
}
