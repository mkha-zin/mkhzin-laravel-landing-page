<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\FeatureResource\Pages;
use App\Filament\App\Resources\FeatureResource\RelationManagers;
use App\Models\Feature;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class FeatureResource extends Resource
{
    protected static ?string $model = Feature::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.features');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.feature');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.App Landing Settings');
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->isSuperAdmin();
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()?->isSuperAdmin();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('dashboard.title'))
                    ->schema([
                        TextInput::make('title_ar')
                            ->label(__('dashboard.title_ar'))
                            ->required()
                            ->maxLength(50),
                        TextInput::make('title_en')
                            ->label(__('dashboard.title_en'))
                            ->required()
                            ->maxLength(50),
                        TextInput::make('icon')
                            ->helperText(__('dashboard.icon_src_desc'))
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(3),
                Section::make(__('dashboard.description'))
                    ->schema([
                        Textarea::make('description_ar')
                            ->label(__('dashboard.description_ar'))
                            ->required()
                            ->maxLength(255),
                        Textarea::make('description_en')
                            ->label(__('dashboard.description_en'))
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make(
                    App::currentLocale() === 'ar' ? 'title_ar' : 'title_en'
                )
                    ->label(__('dashboard.title'))
                    ->searchable(),
                TextColumn::make(
                    App::currentLocale() === 'ar' ? 'description_ar' : 'description_en'
                )
                    ->label(__('dashboard.description'))
                    ->searchable()
                    ->words(10),
                TextColumn::make('icon')
                    ->label(__('dashboard.icon'))
                    ->copyable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                ViewAction::make()->label(''),
                EditAction::make()->label(''),
                DeleteAction::make()->label(''),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFeatures::route('/'),
        ];
    }
}
