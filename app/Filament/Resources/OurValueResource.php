<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OurValueResource\Pages;
use App\Models\OurValue;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section as InfoSection;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\App;

class OurValueResource extends Resource
{
    protected static ?string $model = OurValue::class;
    protected static ?int $navigationSort = 3;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.aboutCompanySettings');
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.ourValues');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.ourValues');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('dashboard.imageAndIcon'))->schema([
                    FileUpload::make('image')
                        ->label(__('dashboard.image'))
                        ->directory('assets/images/ourValues')
                        ->imageEditor()
                        ->image()
                        ->required(),
                    FileUpload::make('icon')
                        ->label(__('dashboard.icon'))
                        ->directory('assets/icons')
                        ->image()
                        ->required()
                ])->columns(2),
                Section::make(__('dashboard.titles'))->schema([
                    TextInput::make('title_ar')
                        ->label(__('dashboard.title_ar'))
                        ->required()
                        ->maxLength(255),
                    TextInput::make('title_en')
                        ->label(__('dashboard.title_en'))
                        ->required()
                        ->maxLength(255),
                ])->columns(2),
                Section::make(__('dashboard.descriptions'))->schema([
                    MarkdownEditor::make('description_ar')
                        ->label(__('dashboard.description_ar'))
                        ->required()
                        ->maxLength(255),
                    MarkdownEditor::make('description_en')
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
                TextColumn::make(
                    App::currentLocale() === 'ar' ? 'title_ar' : 'title_en'
                )
                    ->label(__('dashboard.title'))
                    ->searchable(),

                TextColumn::make(
                    App::currentLocale() === 'ar' ? 'description_ar' : 'description_en'
                )
                    ->label(__('dashboard.description'))
                    ->words(5)
                    ->searchable(),
                ImageColumn::make('image')
                    ->label(__('dashboard.image')),
                ImageColumn::make('icon')
                    ->label(__('dashboard.icon')),
                TextColumn::make('created_at')
                    ->label(__('dashboard.created at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('dashboard.updated at'))
                    ->dateTime()
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([

            InfoSection::make(__('dashboard.imageAndIcon'))->schema([
                ImageEntry::make('image')
                    ->label(__('dashboard.image')),
                ImageEntry::make('icon')
                    ->label(__('dashboard.icon')),
            ])->columns(2),
            InfoSection::make(__('dashboard.titles'))->schema([
                TextEntry::make('title_ar')->label(__('dashboard.title_ar')),
                TextEntry::make('title_en')->label(__('dashboard.title_en')),
            ])->columns(2),
            InfoSection::make(__('dashboard.descriptions'))->schema([
                TextEntry::make('description_ar')->label(__('dashboard.description_ar')),
                TextEntry::make('description_en')->label(__('dashboard.description_en')),
            ])->columns(2)


        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOurValues::route('/'),
            'create' => Pages\CreateOurValue::route('/create'),
            'view' => Pages\ViewOurValue::route('/{record}'),
            'edit' => Pages\EditOurValue::route('/{record}/edit'),
        ];
    }
}
