<?php

namespace App\Filament\Resources\ApplicatorResource\Pages;

use App\Filament\Resources\ApplicatorResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewApplicator extends ViewRecord
{
    protected static string $resource = ApplicatorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
