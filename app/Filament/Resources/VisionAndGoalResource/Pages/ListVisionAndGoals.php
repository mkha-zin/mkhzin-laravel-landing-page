<?php

namespace App\Filament\Resources\VisionAndGoalResource\Pages;

use App\Filament\Resources\VisionAndGoalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVisionAndGoals extends ListRecords
{
    protected static string $resource = VisionAndGoalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
