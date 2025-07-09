<?php

namespace App\Filament\Resources\JoinerResource\Pages;

use App\Filament\Resources\JoinerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJoiner extends EditRecord
{
    protected static string $resource = JoinerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
