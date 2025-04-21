<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SectionResource\Pages;
use App\Models\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section as InfoSection;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use LaraZeus\Delia\Filament\Actions\BookmarkHeaderAction;

class SectionResource extends Resource
{
    protected static ?string $model = Section::class;

    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.servicesManagement');
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.sections');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.section');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getRecordTitleAttribute(): ?string
    {
        return App::currentLocale() === 'ar' ? 'title_ar' : 'title_en';
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title_ar', 'title_en', 'description_ar', 'description_en'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            __('dashboard.name') => App::currentLocale() === 'ar' ? $record->title_ar : $record->title_en,
            __('dashboard.description') => App::currentLocale() === 'ar' ? $record->description_ar : $record->description_en,
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('dashboard.image'))->schema([
                    FileUpload::make('image')
                        ->label(__('dashboard.image'))
                        ->directory('assets/images/sections')
                        ->columnSpanFull()
                        ->imageEditor()
                        ->downloadable()
                        ->image()
                        ->required(),
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
                        ->required(),
                    MarkdownEditor::make('description_en')
                        ->label(__('dashboard.description_en'))
                        ->required(),
                ])->columns(2),
                /*Section::make()->schema([
                    Toggle::make('show_in_home')
                        ->label(__('dashboard.showInHome'))
                        ->default(false),
                ])->columns(1),*/
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
                    ->words(5)
                    ->searchable(),

                TextColumn::make(
                    App::currentLocale() === 'ar' ? 'description_ar' : 'description_en'
                )
                    ->label(__('dashboard.description'))
                    ->words(5)
                    ->searchable(),
                ImageColumn::make('image')
                    ->label(__('dashboard.image')),
                /*IconColumn::make('show_in_home')
                    ->label(__('dashboard.showInHome'))
                    ->boolean()
                ->alignCenter(),*/
                ImageColumn::make('image'),
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

            InfoSection::make(__('dashboard.image'))->schema([
                ImageEntry::make('image')
                    ->label(__('dashboard.image')),

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
            'index' => Pages\ListSections::route('/'),
            'create' => Pages\CreateSection::route('/create'),
            'view' => Pages\ViewSection::route('/{record}'),
            'edit' => Pages\EditSection::route('/{record}/edit'),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            BookmarkHeaderAction::make()
        ];
    }
}
