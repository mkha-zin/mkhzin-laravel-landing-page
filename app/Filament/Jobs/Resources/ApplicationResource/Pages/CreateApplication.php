<?php

namespace App\Filament\Jobs\Resources\ApplicationResource\Pages;

use App\Filament\Jobs\Resources\ApplicationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateApplication extends CreateRecord
{
    protected static string $resource = ApplicationResource::class;
}
