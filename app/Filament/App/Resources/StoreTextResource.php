<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\StoreTextResource\Pages;
use App\Filament\App\Resources\StoreTextResource\RelationManagers;
use App\Models\StoreText;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class StoreTextResource extends Resource
{
    protected static ?string $model = StoreText::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-3-center-left';

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.store texts');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.store text');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.App Landing Settings');
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->isSuperAdmin();
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('dashboard.title'))
                    ->schema([
                        TextInput::make('key')
                            ->label(__('dashboard.key'))
                            ->required()
                            ->disabled(),
                        TextInput::make('title_ar')
                            ->label(__('dashboard.title_ar'))
                            ->required()
                            ->maxLength(255),
                        TextInput::make('title_en')
                            ->label(__('dashboard.title_en'))
                            ->required()
                            ->maxLength(255),
                    ])->columns(3),
                Section::make(__('dashboard.description'))
                    ->schema([
                        TextInput::make('description_ar')
                            ->label(__('dashboard.description_ar'))
                            ->required()
                            ->maxLength(255),
                        TextInput::make('description_en')
                            ->label(__('dashboard.description_en'))
                            ->required()
                            ->maxLength(255),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make(
                    App::currentLocale() === 'en' ? 'title_en' : 'title_ar'
                )
                    ->label(__('dashboard.title'))
                    ->words(5)
                    ->searchable(),
                TextColumn::make(
                    App::currentLocale() === 'en' ? 'description_en' : 'description_ar'
                )
                    ->label(__('dashboard.description'))
                    ->words(10)
                    ->searchable(),
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
            ])
            ->actions([
                ViewAction::make()->label(''),
                EditAction::make()->label(''),
                DeleteAction::make()->label(''),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStoreTexts::route('/'),
        ];
    }
}
