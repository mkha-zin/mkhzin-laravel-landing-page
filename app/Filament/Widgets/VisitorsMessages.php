<?php

namespace App\Filament\Widgets;

use App\Models\VisitorMessage;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Contracts\Support\Htmlable;

class VisitorsMessages extends BaseWidget
{

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->query(
                fn() => VisitorMessage::query()->latest()
            )
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->label(__('dashboard.first_name'))
                    ->searchable()
                    ->words(5),
                Tables\Columns\TextColumn::make('last_name')
                    ->label(__('dashboard.last_name'))
                    ->searchable()
                    ->words(5),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('dashboard.email'))
                    ->words(5),
                Tables\Columns\TextColumn::make('subject')
                    ->label(__('dashboard.subject'))
                    ->words(5),
                Tables\Columns\TextColumn::make('message')
                    ->label(__('dashboard.message'))
                    ->words(5),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('dashboard.Created At'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('dashboard.Updated At'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ]);
    }

    protected function getTableHeading(): string|Htmlable|null
    {
        return __('dashboard.visitor_message');
    }
}
