<?php

namespace App\Filament\Resources\BranchResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\App;
use Mokhosh\FilamentRating\Columns\RatingColumn;
use Mokhosh\FilamentRating\RatingTheme;

class ReviewsRelationManager extends RelationManager
{
    protected static string $relationship = 'reviews';


    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('dashboard.customer reviews');
    }


    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make(
                    App::currentLocale() === 'ar' ? 'branch.name_ar' : 'branch.name_en'
                )
                    ->label(__('dashboard.branch'))
                    ->searchable()
                    ->alignCenter()
                    ->sortable(),
                TextColumn::make('name')
                    ->label(__('dashboard.customer name'))
                    ->sortable()
                    ->words(2)
                    ->searchable(),
                TextColumn::make('platform')
                    ->label(__('dashboard.platform'))
                    ->formatStateUsing(
                        fn($state) => __('dashboard.' . $state)
                    )
                    ->alignCenter()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('link')
                    ->searchable()
                    ->limit(10)
                    ->toggleable(isToggledHiddenByDefault: true),
                RatingColumn::make('stars')
                    ->label(__('dashboard.stars'))
                    ->color('warning')
                    ->theme(RatingTheme::HalfStars)
                    ->sortable(),
                TextColumn::make('review')
                    ->label(__('dashboard.customer review'))
                    ->words(3)
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ]);
    }
}
