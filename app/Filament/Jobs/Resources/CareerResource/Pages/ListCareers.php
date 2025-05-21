<?php

namespace App\Filament\Jobs\Resources\CareerResource\Pages;

use App\Filament\Jobs\Resources\CareerResource;
use App\Filament\Jobs\Widgets\JobsStatsOverview;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCareers extends ListRecords
{
    protected static string $resource = CareerResource::class;

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
