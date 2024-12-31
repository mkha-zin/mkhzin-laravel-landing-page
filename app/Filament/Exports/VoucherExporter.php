<?php

namespace App\Filament\Exports;

use App\Models\Voucher;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class VoucherExporter extends Exporter
{
    protected static ?string $model = Voucher::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('#'),
            ExportColumn::make('voucher')
                ->label(__('dashboard.voucher')),
            ExportColumn::make('c_name')
                ->label(__('dashboard.customer name')),
            ExportColumn::make('phone')
                ->label(__('dashboard.customer phone')),
            ExportColumn::make('used')
                ->label(__('dashboard.Used')),
            ExportColumn::make('using_date')
                ->label(__('dashboard.using_date')),
            ExportColumn::make('created_at')
                ->enabledByDefault(false),
            ExportColumn::make('updated_at')
                ->enabledByDefault(false),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your voucher export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
