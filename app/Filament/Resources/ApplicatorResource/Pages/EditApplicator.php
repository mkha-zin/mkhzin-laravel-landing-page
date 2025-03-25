<?php

namespace App\Filament\Resources\ApplicatorResource\Pages;

use App\Filament\Resources\ApplicatorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditApplicator extends EditRecord
{
    protected static string $resource = ApplicatorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
