<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\StoreStepResource\Pages;
use App\Filament\App\Resources\StoreStepResource\RelationManagers;
use App\Models\StoreStep;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class StoreStepResource extends Resource
{
    protected static ?string $model = StoreStep::class;

    protected static ?string $navigationIcon = 'heroicon-o-numbered-list';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.steps');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.step');
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
                Forms\Components\Section::make(__('dashboard.title'))
                    ->schema([
                        Forms\Components\TextInput::make('order')
                            ->label(__('dashboard.order'))
                            ->required()
                            ->unique()
                            ->numeric(),
                        Forms\Components\TextInput::make('title_ar')
                            ->label(__('dashboard.title_ar'))
                            ->required()
                            ->maxLength(20),
                        Forms\Components\TextInput::make('title_en')
                            ->label(__('dashboard.title_en'))
                            ->required()
                            ->maxLength(20),
                    ])->columns(3),
                Forms\Components\Section::make(__('dashboard.description'))
                    ->schema([
                        Forms\Components\Textarea::make('description_ar')
                            ->label(__('dashboard.description_ar'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description_en')
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
                Tables\Columns\TextColumn::make('order')
                    ->label(__('dashboard.order'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make(
                    App::currentLocale() === 'en' ? 'title_en' : 'title_ar'
                )
                    ->label(__('dashboard.title'))
                    ->searchable(),
                Tables\Columns\TextColumn::make(
                    App::currentLocale() === 'en' ? 'description_en' : 'description_ar'
                )
                    ->label(__('dashboard.description'))
                    ->words(8)
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
                Tables\Actions\ViewAction::make()->label('')->tooltip(__('dashboard.view')),
                Tables\Actions\EditAction::make()->label('')->tooltip(__('dashboard.edit')),
                Tables\Actions\DeleteAction::make()->label('')->tooltip(__('dashboard.delete')),
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
            'index' => Pages\ListStoreSteps::route('/'),
        ];
    }
}
