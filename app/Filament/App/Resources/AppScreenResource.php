<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\AppScreenResource\Pages;
use App\Filament\App\Resources\AppScreenResource\RelationManagers;
use App\Models\AppScreen;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class AppScreenResource extends Resource
{
    protected static ?string $model = AppScreen::class;

    protected static ?string $navigationIcon = 'heroicon-o-device-phone-mobile';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.app screens');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.app screen');
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
                Section::make()
                    ->schema([
                        TextInput::make('title')
                            ->label(__('dashboard.title'))
                            ->required()
                            ->maxLength(255),
                        FileUpload::make('image')
                            ->label(__('dashboard.image'))
                            ->image()
                            ->imageEditor()
                            ->directory('assets/images/screens')
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('dashboard.title'))
                    ->sortable()
                    ->searchable(),
                ImageColumn::make('image')
                    ->label(__('dashboard.image')),
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
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAppScreens::route('/'),
        ];
    }
}
