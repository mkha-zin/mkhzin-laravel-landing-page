<?php

namespace App\Filament\Resources\VisionAndGoalResource\Pages;

use App\Filament\Resources\VisionAndGoalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVisionAndGoal extends EditRecord
{
    protected static string $resource = VisionAndGoalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
