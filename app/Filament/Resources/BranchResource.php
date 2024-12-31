<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BranchResource\Pages;
use App\Filament\Resources\BranchResource\RelationManagers;
use App\Models\Branch;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\App;

class BranchResource extends Resource
{
    protected static ?string $model = Branch::class;
    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.servicesManagement');
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.branches');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.branches');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([
                    Forms\Components\Select::make('city_id')
                        ->relationship('city',
                            App::currentLocale() === 'ar' ? 'name_ar' : 'name_en')
                        ->default(null),
                    Forms\Components\Select::make('type')
                        ->label(__('dashboard.type'))
                        ->options([
                            'super' => __('dashboard.super'),
                            'hyper' => __('dashboard.hyper'),
                            'wholesale' => __('dashboard.wholesale'),
                        ]),
                ])->columns(2),
                Forms\Components\Section::make()->schema([
                    Forms\Components\TextInput::make('name_ar')
                        ->label(__('dashboard.name_ar'))
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('name_en')
                        ->label(__('dashboard.name_en'))
                        ->required()
                        ->maxLength(255),
                ])->columns(2),
                Forms\Components\Section::make(__('dashboard.addresses'))->schema([
                    Forms\Components\TextInput::make('address_ar')
                        ->label(__('dashboard.address_ar'))
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('address_en')
                        ->label(__('dashboard.address_en'))
                        ->required()
                        ->maxLength(255),
                ])->columns(2),
                Forms\Components\Section::make(__('dashboard.files'))->schema([
                    Forms\Components\FileUpload::make('image')
                        ->label(__('dashboard.image'))
                        ->directory('assets/images/branches')
                        ->imageEditor()
                        ->image()
                        ->required(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make(
                    App::currentLocale() === 'ar' ? 'city.name_ar' : 'city.name_en'
                )
                    ->label(__('dashboard.city'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make(
                    App::currentLocale() === 'ar' ? 'name_ar' : 'name_en'
                )
                    ->label(__('dashboard.name'))
                    ->searchable(),

                Tables\Columns\TextColumn::make(
                    App::currentLocale() === 'ar' ? 'address_ar' : 'address_en'
                )
                    ->label(__('dashboard.address'))
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('dashboard.created at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('dashboard.updated at'))
                    ->dateTime()
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([

            Section::make(__('dashboard.image'))->schema([
                ImageEntry::make('image')
                    ->label(__('dashboard.image')),
            ])->columns(2),
            Section::make(__(''))->schema([
                TextEntry::make('name_ar')->label(__('dashboard.name_ar')),
                TextEntry::make('name_en')->label(__('dashboard.name_en')),
            ])->columns(2),
            Section::make(__('dashboard.addresses'))->schema([
                TextEntry::make('address_ar')->label(__('dashboard.address_ar')),
                TextEntry::make('address_en')->label(__('dashboard.address_en')),
            ])->columns(2),
            Section::make(__(''))->schema([
                TextEntry::make(
                    App::currentLocale() === 'ar' ? 'city.name_ar' : 'city.name_en'
                )->label(__('dashboard.city')),
            ])->columns(2)


        ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\OfferRelationManager::class

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBranches::route('/'),
            'create' => Pages\CreateBranch::route('/create'),
            'view' => Pages\ViewBranch::route('/{record}'),
            'edit' => Pages\EditBranch::route('/{record}/edit'),
        ];
    }
}
