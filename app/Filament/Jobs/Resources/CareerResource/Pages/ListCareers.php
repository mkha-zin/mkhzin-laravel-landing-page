<?php

namespace App\Filament\Jobs\Resources\CareerResource\Pages;

use App\Filament\Jobs\Resources\CareerResource;
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
}
