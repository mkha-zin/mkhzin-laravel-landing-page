<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Filament\Resources\GalleryResource\RelationManagers;
use App\Models\Gallery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Table;
use Illuminate\Support\Facades\App;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;
    protected static ?int $navigationSort = 5;

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.aboutCompanySettings');
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.gallery');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.Image');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('branch_id')
                    ->label(__('dashboard.branch'))
                    ->relationship('branch', \App::currentLocale() === 'ar' ? 'name_ar' : 'name_en')
                    ->required(),
                Forms\Components\Toggle::make('status')
                    ->label(__('dashboard.status')),
                Forms\Components\TextInput::make('link')
                    ->label(__('dashboard.link'))
                    ->maxLength(191)
                    ->default(null),
                Forms\Components\Select::make('type')
                    ->label(__('dashboard.type'))
                    ->options([
                        'image' => __('dashboard.image'),
                        'video' => __('dashboard.video'),
                    ]),

                Forms\Components\FileUpload::make('image')
                    ->label(__('dashboard.Image'))
                    ->editableSvgs()
                    ->directory('assets/videos/gallery')
                    ->columnSpanFull()
                    ->required(),
                Forms\Components\TextInput::make('title_ar')
                    ->label(__('dashboard.title_ar'))
                    ->maxLength(191)
                    ->default(null),
                Forms\Components\TextInput::make('title_en')
                    ->label(__('dashboard.title_en'))
                    ->maxLength(191)
                    ->default(null),
                Forms\Components\Textarea::make('description_ar')
                    ->label(__('dashboard.description_ar'))
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Textarea::make('description_en')
                    ->label(__('dashboard.description_en'))
                    ->maxLength(255)
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('branch.name_' . App::currentLocale())
                    ->label(__('dashboard.branch'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label(__('dashboard.Image')),
                Tables\Columns\TextColumn::make('title_' . App::currentLocale())
                    ->label(__('dashboard.title'))
                    ->words(5)
                    ->searchable(),
                Tables\Columns\TextColumn::make('description_' . App::currentLocale())
                    ->label(__('dashboard.description'))
                    ->words(5)
                    ->searchable(),
                Tables\Columns\TextColumn::make('link')
                    ->label(__('dashboard.link'))
                    ->limit(12)
                    ->url(fn($record) => $record->link,true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label(__('dashboard.type'))
                    ->formatStateUsing(
                        fn($state) => __('dashboard.' . $state)
                    )
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('status')
                    ->label(__('dashboard.status'))
                    ->icon(fn($state) => $state === 'active' ? 'heroicon-s-check-circle' : 'heroicon-s-x-circle')
                    ->color(fn($state) => $state === 'active' ? 'success' : 'danger')
                    ->alignCenter()
                    ->action(fn($record) => $record->status === 'active' ? $record->update(['status' => 'inactive']) : $record->update(['status' => 'active']))
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('dashboard.created at'))
                    ->date()
                    ->dateTimeTooltip('Y/m/d h:i:s A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
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
            'index' => Pages\ManageGalleries::route('/'),
        ];
    }
}
