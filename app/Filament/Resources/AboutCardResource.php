<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutCardResource\Pages;
use App\Filament\Resources\AboutCardResource\RelationManagers;
use App\Models\AboutCard;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Navigation\NavigationGroup;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\App;

class AboutCardResource extends Resource
{
    protected static ?string $model = AboutCard::class;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    
    protected static ?int $navigationSort = 2;
    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.aboutCompanySettings');
    }


    public static function getPluralLabel(): ?string
    {
        return __('dashboard.about_cards');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.about_cards');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('dashboard.titles'))->schema([
                    Forms\Components\TextInput::make('title_ar')
                        ->label(__('dashboard.title_ar'))
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('title_en')
                        ->label(__('dashboard.title_en'))
                        ->required()
                        ->maxLength(255),
                ])->columns(2),
                Forms\Components\Section::make(__('dashboard.titles'))->schema([
                    Forms\Components\MarkdownEditor::make('description_ar')
                        ->label(__('dashboard.description_ar'))
                        ->required(),
                    Forms\Components\MarkdownEditor::make('description_en')
                        ->label(__('dashboard.description_en'))
                        ->required(),
                ])->columns(2),
                Forms\Components\Section::make(__(''))->schema([
                    Forms\Components\FileUpload::make('icon')
                        ->label(__('dashboard.icon'))
                        ->directory('assets/icons')
                        ->required(),
                ]),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make(
                    App::currentLocale() == 'ar' ? 'title_ar' : 'title_en'
                )
                    ->label(__('dashboard.title'))
                    ->words(5)
                    ->searchable(),
                Tables\Columns\TextColumn::make(
                    App::currentLocale() == 'ar' ? 'description_ar' : 'description_en'
                )
                    ->label(__('dashboard.description'))
                    ->words(5)
                    ->searchable(),
                Tables\Columns\ImageColumn::make('icon')
                    ->label(__('dashboard.icon'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
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
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([

            Section::make(__(''))->schema([
                ImageEntry::make('icon')
                    ->label(__('dashboard.icon')),
            ])->columns(2),
            Section::make(__('dashboard.titles'))->schema([
                TextEntry::make('title_ar')->label(__('dashboard.title_ar')),
                TextEntry::make('title_en')->label(__('dashboard.title_en')),
            ])->columns(2),
            Section::make(__('dashboard.descriptions'))->schema([
                TextEntry::make('description_ar')->label(__('dashboard.description_ar')),
                TextEntry::make('description_en')->label(__('dashboard.description_en')),
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
            'index' => Pages\ListAboutCards::route('/'),
            'create' => Pages\CreateAboutCard::route('/create'),
            'view' => Pages\ViewAboutCard::route('/{record}'),
            'edit' => Pages\EditAboutCard::route('/{record}/edit'),
        ];
    }
}
