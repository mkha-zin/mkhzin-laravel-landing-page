<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\CategoryResource\Pages;
use App\Filament\App\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.categories');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.category');
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
                            ->maxLength(20),
                        TextInput::make('title_en')
                            ->label(__('dashboard.title_en'))
                            ->required()
                            ->maxLength(20),
                    ])->columns(2),
                Section::make(__('dashboard.image'))
                    ->schema([
                        FileUpload::make('image')
                            ->label(__('dashboard.image'))
                            ->directory('assets/images/categories')
                            ->image()
                            ->imageEditor()
                            ->required()
                    ])
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
            'index' => Pages\ListCategories::route('/'),
        ];
    }
}
