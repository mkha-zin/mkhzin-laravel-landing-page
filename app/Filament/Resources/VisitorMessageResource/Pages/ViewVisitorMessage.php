<?php

namespace App\Filament\Resources\VisitorMessageResource\Pages;

use App\Filament\Resources\VisitorMessageResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewVisitorMessage extends ViewRecord
{
    protected static string $resource = VisitorMessageResource::class;


    public function getRecordTitle(): string|Htmlable
    {
        return __('dashboard.message from') . ': ' . $this->record->first_name;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
