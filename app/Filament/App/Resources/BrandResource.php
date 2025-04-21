<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\BrandResource\Pages;
use App\Filament\App\Resources\BrandResource\RelationManagers;
use App\Models\Brand;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section as InfoSection;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;
    protected static ?string $navigationIcon = 'heroicon-o-finger-print';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.brands');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.brand');
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
                            ->required()
                            ->label(__('dashboard.title'))
                            ->maxLength(255),
                        FileUpload::make('image')
                            ->image()
                            ->imageEditor()
                            ->label(__('dashboard.image'))
                            ->directory('assets/images/brands')
                            ->required(),
                    ])->columns(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->sortable()
                    ->label(__('dashboard.title'))
                    ->searchable(),
                ImageColumn::make('image')
                    ->label(__('dashboard.image')),
                TextColumn::make('created_at')
                    ->date()
                    ->dateTimeTooltip(format: 'Y/m/d h:i:s A')
                    ->label(__('dashboard.created at'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->date()
                    ->dateTimeTooltip(format: 'Y/m/d h:i:s A')
                    ->label(__('dashboard.updated at'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfoSection::make(
                    $infolist->record->title
                )->schema([
                    ImageEntry::make('image')
                        ->label(__('dashboard.image'))
                ])
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBrands::route('/'),
        ];
    }
}
