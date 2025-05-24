<?php

namespace App\Filament\Exports;

use App\Models\Application;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Facades\Storage;

class ApplicationExporter extends Exporter
{
    protected static ?string $model = Application::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('job.title')
                ->label(__('dashboard.Career')),
            ExportColumn::make('name')
                ->label(__('dashboard.name')),
            ExportColumn::make('email')
                ->label(__('dashboard.email')),
            ExportColumn::make('phone')
                ->label(__('dashboard.phone')),
            ExportColumn::make('address')
                ->label(__('dashboard.address')),
            ExportColumn::make('resume_link')
                ->label(__('dashboard.resume'))
                ->formatStateUsing(function ($state) {
                    return url(Storage::url($state));
                }),
            ExportColumn::make('answers')
                ->label(__('dashboard.QaA'))

                ->formatStateUsing(function ($state) {
                    $decoded = json_decode($state, true);

                    if (!is_array($decoded) || empty($decoded)) {
                        return 'No answers';
                    }

                    return collect($decoded)->map(function ($item, $index) {
                        $question = $item['question'] ?? __('dashboard.question') . ($index + 1);
                        $answer = $item['answer'] ?? 'No answer';
                        return __('dashboard.q') . ($index + 1) . ": $question\n" . __('dashboard.a') . ": $answer";
                    })->implode("\n________________________\n");
                }),

            ExportColumn::make('created_at')
                ->label(__('dashboard.created at')),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your application export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
