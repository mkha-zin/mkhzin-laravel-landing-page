<?php

namespace App\Filament\Resources\VisionAndGoalResource\Pages;

use App\Filament\Resources\VisionAndGoalResource;
use App\Http\Controllers\util\Common;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateVisionAndGoal extends CreateRecord
{
    protected static string $resource = VisionAndGoalResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['slug'] = Common::createSlug();
        return $data;
    }
}
