<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StorageResource\Pages;
use App\Models\Storage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class StorageResource extends Resource
{
    protected static ?string $model = Storage::class;
    protected static ?int $navigationSort = 4;

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.servicesManagement');
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.storage');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.storage');
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('dashboard.images'))->schema([
                    Forms\Components\FileUpload::make('background_image')
                        ->label(__('dashboard.background_image'))
                        ->directory('assets/images/storage')
                        ->imageEditor()
                        ->image()
                        ->required(),
                    Forms\Components\FileUpload::make('foreground_image')
                        ->label(__('dashboard.foreground_image'))
                        ->directory('assets/images/storage')
                        ->imageEditor()
                        ->image()
                        ->required(),
                ])->columns(2),
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
                Forms\Components\Section::make(__('dashboard.descriptions'))->schema([
                    Forms\Components\MarkdownEditor::make('description_ar')
                        ->label(__('dashboard.description_ar'))
                        ->required(),
                    Forms\Components\MarkdownEditor::make('description_en')
                        ->label(__('dashboard.description_en'))
                        ->required(),
                ])->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make(
                    App::currentLocale() === 'ar' ? 'title_ar' : 'title_en'
                )
                    ->label(__('dashboard.title'))
                    ->words(5)
                    ->searchable(),

                Tables\Columns\TextColumn::make(
                    App::currentLocale() === 'ar' ? 'description_ar' : 'description_en'
                )
                    ->label(__('dashboard.description'))
                    ->words(5)
                    ->searchable(),

                Tables\Columns\ImageColumn::make('background_image'),
                Tables\Columns\ImageColumn::make('foreground_image'),

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
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([

            Section::make(__('dashboard.images'))->schema([
                ImageEntry::make('background_image')
                    ->label(__('dashboard.background_image')),
                ImageEntry::make('foreground_image')
                    ->label(__('dashboard.foreground_image')),

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
            'index' => Pages\ListStorages::route('/'),
            'create' => Pages\CreateStorage::route('/create'),
            'view' => Pages\ViewStorage::route('/{record}'),
            'edit' => Pages\EditStorage::route('/{record}/edit'),
        ];
    }
}
