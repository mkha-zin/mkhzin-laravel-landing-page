<?php

namespace App\Filament\Resources\VisionAndGoalResource\Pages;

use App\Filament\Resources\VisionAndGoalResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewVisionAndGoal extends ViewRecord
{
    protected static string $resource = VisionAndGoalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
