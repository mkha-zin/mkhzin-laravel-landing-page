<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\AppScreenResource\Pages;
use App\Filament\App\Resources\AppScreenResource\RelationManagers;
use App\Models\AppScreen;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
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
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label(__('dashboard.title'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('image')
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
                Tables\Columns\TextColumn::make('title')
                    ->label(__('dashboard.title'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label(__('dashboard.image')),
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListAppScreens::route('/'),
        ];
    }
}
