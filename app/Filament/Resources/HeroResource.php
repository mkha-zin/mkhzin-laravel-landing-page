<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroResource\Pages;
use App\Filament\Resources\HeroResource\RelationManagers;
use App\Models\Hero;
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

class HeroResource extends Resource
{
    protected static ?string $model = Hero::class;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }


    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.pageManagement');
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.hero');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.hero');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('')->schema([
                    Forms\Components\FileUpload::make('image')->label(__('dashboard.image'))
                        ->directory('assets/images/heroes')
                        ->image()
                        ->imageEditor()
                        ->columnSpanFull()
                        ->required(),
                ]),
                Forms\Components\Section::make(__('dashboard.titles'))->schema([
                    Forms\Components\TextInput::make('title_ar')->label(__('dashboard.title_ar'))
                        ->required()
                        ->maxValue(45),
                    Forms\Components\TextInput::make('title_en')->label(__('dashboard.title_en'))
                        ->required()
                        ->maxValue(45),
                ])->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make(
                    App::currentLocale() == 'ar' ? 'title_ar' : 'title_en'
                )->label(__('dashboard.title')),

                Tables\Columns\ImageColumn::make('image')
                    ->label(__('dashboard.image')),

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


            ImageEntry::make('image')->label(__('dashboard.image')),
            Section::make(__('dashboard.titles'))->schema([
                TextEntry::make('title_ar')->label(__('dashboard.title_ar')),
                TextEntry::make('title_en')->label(__('dashboard.title_en')),
            ])->columns(2)


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
            'index' => Pages\ListHeroes::route('/'),
            'create' => Pages\CreateHero::route('/create'),
            'view' => Pages\ViewHero::route('/{record}'),
            'edit' => Pages\EditHero::route('/{record}/edit'),
        ];
    }
}
