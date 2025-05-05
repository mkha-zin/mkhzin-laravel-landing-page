<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerReviewResource\Pages;
use App\Filament\Resources\CustomerReviewResource\RelationManagers;
use App\Models\CustomerReview;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

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
                Forms\Components\Select::make('branch_id')
                    ->label(__('dashboard.branch'))
                    ->relationship('branch', \App::currentLocale() === 'ar' ? 'name_ar' : 'name_en')
                    ->required(),
                Forms\Components\Select::make('platform')
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
                Forms\Components\TextInput::make('name')
                    ->label(__('dashboard.customer name'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('stars')
                    ->label(__('dashboard.stars'))
                    ->required()
                    ->numeric()
                    ->maxValue(5)
                    ->minValue(1)
                    ->maxLength(1),
                Forms\Components\TextInput::make('link')
                    ->label(__('dashboard.link'))
                    ->url()
                    ->columnSpanFull(),
                Forms\Components\MarkdownEditor::make('review')
                    ->label(__('dashboard.customer review'))
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make(
                    \App::currentLocale() === 'ar' ? 'branch.name_ar' : 'branch.name_en'
                )
                    ->label(__('dashboard.branch'))
                    ->searchable()
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('dashboard.customer name'))
                    ->sortable()
                    ->words(2)
                    ->searchable(),
                Tables\Columns\TextColumn::make('platform')
                    ->label(__('dashboard.platform'))
                    ->formatStateUsing(
                        fn ($state) => __('dashboard.' . $state)
                    )
                    ->alignCenter()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('link')
                    ->searchable()
                    ->limit(10)
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('stars')
                    ->label(__('dashboard.stars'))
                    ->alignCenter()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('review')
                    ->label(__('dashboard.customer review'))
                    ->words(3)
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->iconButton(),
                Tables\Actions\DeleteAction::make()->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCustomerReviews::route('/'),
        ];
    }
}
