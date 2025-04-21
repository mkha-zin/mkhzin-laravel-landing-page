<?php

namespace App\Filament\Jobs\Resources\CareerResource\RelationManagers;

use App\Models\Application;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ApplicationsRelationManager extends RelationManager
{
    protected static string $relationship = 'applications';

    protected static ?string $recordTitleAttribute = 'name';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('dashboard.Applications');
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('job.title')
                    ->label(__('dashboard.Career'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('name')
                    ->label(__('dashboard.name'))
                    ->searchable(),
                TextColumn::make('phone')
                    ->label(__('dashboard.contact info'))
                    ->description(fn(Application $record): string => $record->email)
                    ->copyable()
                    ->searchable(),
                TextColumn::make('address')
                    ->label(__('dashboard.address'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                ViewColumn::make('answers')
                    ->label(__('dashboard.QaA'))
                    ->view('jobs.answers_view'),
                IconColumn::make('resume_link')
                    ->icon('heroicon-o-arrow-down-circle')
                    ->alignCenter()
                    ->color('success')
                    ->label(__('dashboard.resume'))
                    ->url(function ($record) {
                        $data['resume_link'] = $record->resume_link;
                        $data['key'] = $record->id;
                        return route('resume.download', $data);
                    }),
                TextColumn::make('created_at')
                    ->label(__('dashboard.created at'))
                    ->date()
                    ->dateTimeTooltip('D Y/M/d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('dashboard.updated at'))
                    ->date()
                    ->dateTimeTooltip('D Y/M/d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ]);
    }
}
