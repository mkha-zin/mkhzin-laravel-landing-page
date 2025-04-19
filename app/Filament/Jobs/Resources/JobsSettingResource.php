<?php

namespace App\Filament\Jobs\Resources;

use App\Filament\Jobs\Resources\JobsSettingResource\Pages\Settings;
use App\Models\JobsSetting;
use Filament\Resources\Resource;

class JobsSettingResource extends Resource
{
    protected static ?string $model = JobsSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';


    public static function getPluralLabel(): ?string
    {
        return __('dashboard.Settings');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.Jobs Settings');
    }


    public static function getPages(): array
    {
        return [
            'index' => Settings::route('/'),
        ];
    }
}
