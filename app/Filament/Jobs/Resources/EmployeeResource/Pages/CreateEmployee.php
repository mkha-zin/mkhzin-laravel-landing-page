<?php

namespace App\Filament\Jobs\Resources\EmployeeResource\Pages;

use App\Filament\Jobs\Resources\EmployeeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEmployee extends CreateRecord
{
    protected static string $resource = EmployeeResource::class;
}
