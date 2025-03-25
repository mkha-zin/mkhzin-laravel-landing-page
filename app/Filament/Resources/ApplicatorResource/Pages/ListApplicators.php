<?php

namespace App\Filament\Resources\ApplicatorResource\Pages;

use App\Filament\Resources\ApplicatorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListApplicators extends ListRecords
{
    protected static string $resource = ApplicatorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
