<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\StoreTextResource\Pages;
use App\Filament\App\Resources\StoreTextResource\RelationManagers;
use App\Models\StoreText;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
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
                Forms\Components\Section::make(__('dashboard.title'))
                    ->schema([
                        Forms\Components\TextInput::make('key')
                            ->label(__('dashboard.key'))
                            ->required()
                            ->disabled(),
                        Forms\Components\TextInput::make('title_ar')
                            ->label(__('dashboard.title_ar'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('title_en')
                            ->label(__('dashboard.title_en'))
                            ->required()
                            ->maxLength(255),
                    ])->columns(3),
                Forms\Components\Section::make(__('dashboard.description'))
                    ->schema([
                        Forms\Components\TextInput::make('description_ar')
                            ->label(__('dashboard.description_ar'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('description_en')
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
                Tables\Columns\TextColumn::make(
                    App::currentLocale() === 'en' ? 'title_en' : 'title_ar'
                )
                    ->label(__('dashboard.title'))
                    ->words(5)
                    ->searchable(),
                Tables\Columns\TextColumn::make(
                    App::currentLocale() === 'en' ? 'description_en' : 'description_ar'
                )
                    ->label(__('dashboard.description'))
                    ->words(10)
                    ->searchable(),
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
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->label(''),
                Tables\Actions\EditAction::make()->label(''),
                Tables\Actions\DeleteAction::make()->label(''),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStoreTexts::route('/'),
            'create' => Pages\CreateStoreText::route('/create'),
            'view' => Pages\ViewStoreText::route('/{record}'),
            'edit' => Pages\EditStoreText::route('/{record}/edit'),
        ];
    }
}
