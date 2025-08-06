<?php

namespace App\Filament\Resources;

use App;
use App\Filament\Resources\CustomerReviewResource\Pages;
use App\Filament\Resources\CustomerReviewResource\RelationManagers;
use App\Models\CustomerReview;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Mokhosh\FilamentRating\Columns\RatingColumn;
use Mokhosh\FilamentRating\Components\Rating;
use Mokhosh\FilamentRating\RatingTheme;

class CustomerReviewResource extends Resource
{
    protected static ?string $model = CustomerReview::class;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.our customers');
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.customer reviews');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.customer review');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('branch_id')
                    ->label(__('dashboard.branch'))
                    ->relationship('branch', App::currentLocale() === 'ar' ? 'name_ar' : 'name_en')
                    ->required(),
                Select::make('platform')
                    ->label(__('dashboard.platform'))
                    ->required()
                    ->options([
                        'google maps' => __('dashboard.google maps'),
                        'google play' => __('dashboard.google play'),
                        'facebook' => __('dashboard.facebook'),
                        'twitter' => __('dashboard.twitter'),
                        'instagram' => __('dashboard.instagram'),
                        'snapchat' => __('dashboard.snapchat'),
                        'tiktok' => __('dashboard.tiktok'),
                        'whatsapp' => __('dashboard.whatsapp'),
                        'telegram' => __('dashboard.telegram'),
                        'linkedin' => __('dashboard.linkedin'),
                        'youtube' => __('dashboard.youtube'),
                    ]),
                TextInput::make('name')
                    ->label(__('dashboard.customer name'))
                    ->required()
                    ->maxLength(255),
                Rating::make('stars')
                    ->label(__('dashboard.stars'))
                    ->required()
                    ->stars(5)
                    ->color('warning')
                    ->size('xl')
                    ->theme(RatingTheme::HalfStars),
                TextInput::make('link')
                    ->label(__('dashboard.link'))
                    ->url(),
                Toggle::make('is_active')
                    ->label(__('dashboard.is_active'))
                    ->default(true),
                MarkdownEditor::make('review')
                    ->label(__('dashboard.customer review'))
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
                    ->label(__('dashboard.link'))
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
                    ->tooltip(fn(CustomerReview $record) => $record->review)
                    ->searchable(),
                ToggleColumn::make('is_active')
                    ->label(__('dashboard.is_active'))
                    ->tooltip(fn(CustomerReview $record) => $record->is_active ? __('dashboard.active') : __('dashboard.inactive'))
                    ->sortable()
                    ->alignCenter(),
                TextColumn::make('created_at')
                    ->label(__('dashboard.created at'))
                    ->date()
                    ->dateTimeTooltip('Y/m/d h:i:s A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('dashboard.updated at'))
                    ->date()
                    ->dateTimeTooltip('Y/m/d h:i:s A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->extremePaginationLinks()
            ->actions([
                EditAction::make()->iconButton(),
                DeleteAction::make()->iconButton(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCustomerReviews::route('/'),
        ];
    }
}
