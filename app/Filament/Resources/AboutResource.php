<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutResource\Pages;
use App\Models\About;
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
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class AboutResource extends Resource
{
    protected static ?string $model = About::class;

    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.aboutCompanySettings');
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.about');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.about');
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

                Section::make(__('dashboard.texts'))->schema([
                    MarkdownEditor::make('first_text_ar')
                        ->label(__('dashboard.first_text_ar'))
                        ->required(),
                    MarkdownEditor::make('first_text_en')
                        ->label(__('dashboard.first_text_en'))
                        ->required(),
                    MarkdownEditor::make('second_text_ar')
                        ->label(__('dashboard.second_text_ar'))
                        ->required(),
                    MarkdownEditor::make('second_text_en')
                        ->label(__('dashboard.second_text_en'))
                        ->required(),
                ])->columns(2),
                Section::make('')->schema([
                    FileUpload::make('image')
                        ->directory('assets/images/about')
                        ->imageEditor()
                        ->label(__('dashboard.image'))
                        ->image()
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make(
                    App::currentLocale() === 'ar' ? 'title_ar' : 'title_en'
                )->label(__('dashboard.title'))
                    ->searchable(),
                TextColumn::make(
                    App::currentLocale() === 'ar' ? 'first_text_ar' : 'first_text_en'
                )
                    ->label(__('dashboard.first_text'))
                    ->words(5)
                    ->searchable(),

                TextColumn::make(
                    App::currentLocale() === 'ar' ? 'second_text_ar' : 'second_text_en'
                )
                    ->label(__('dashboard.second_text'))
                    ->words(5)
                    ->searchable(),
                ImageColumn::make('image')
                    ->label(__('dashboard.image')),
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
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([

            InfoSection::make('')->schema([
                ImageEntry::make('image')
                    ->label(__('dashboard.image'))->columnSpanFull(),
            ])->columnSpanFull(),

            InfoSection::make(__('dashboard.titles'))->schema([
                TextEntry::make('title_ar')->label(__('dashboard.title_ar')),
                TextEntry::make('title_en')->label(__('dashboard.title_en')),
            ])->columns(2),
            InfoSection::make(__('dashboard.texts'))->schema([
                TextEntry::make('first_text_ar')->label(__('dashboard.first_text_ar')),
                TextEntry::make('first_text_en')->label(__('dashboard.first_text_en')),
                TextEntry::make('second_text_ar')->label(__('dashboard.second_text_ar')),
                TextEntry::make('second_text_en')->label(__('dashboard.second_text_en')),
            ])->columns(2)


        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAbouts::route('/'),
            'create' => Pages\CreateAbout::route('/create'),
            'view' => Pages\ViewAbout::route('/{record}'),
            'edit' => Pages\EditAbout::route('/{record}/edit'),
        ];
    }
}
