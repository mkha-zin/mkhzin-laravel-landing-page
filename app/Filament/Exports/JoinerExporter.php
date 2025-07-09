<?php

namespace App\Filament\Exports;

use App\Models\Joiner;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class JoinerExporter extends Exporter
{
    protected static ?string $model = Joiner::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('#'),
            ExportColumn::make('name')->label(__('dashboard.name')),
            ExportColumn::make('phone')->label(__('dashboard.phone')),
            ExportColumn::make('tiktok_user')->label(__('dashboard.tiktok_user')),
            ExportColumn::make('comment_image')->label(__('dashboard.comment_image')),
            ExportColumn::make('deleted_at')->label(__('dashboard.deleted at')),
            ExportColumn::make('created_at')->label(__('dashboard.created at')),
            ExportColumn::make('updated_at')->label(__('dashboard.updated at')),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your joiner export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
