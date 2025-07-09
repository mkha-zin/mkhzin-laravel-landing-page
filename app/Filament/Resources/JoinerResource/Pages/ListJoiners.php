<?php

namespace App\Filament\Resources\JoinerResource\Pages;

use App\Filament\Resources\JoinerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJoiners extends ListRecords
{
    protected static string $resource = JoinerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
