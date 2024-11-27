<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutResource\Pages;
use App\Filament\Resources\AboutResource\RelationManagers;
use App\Models\About;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
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

                Forms\Components\Section::make(__('dashboard.texts'))->schema([
                    Forms\Components\MarkdownEditor::make('first_text_ar')
                        ->label(__('dashboard.first_text_ar'))
                        ->required(),
                    Forms\Components\MarkdownEditor::make('first_text_en')
                        ->label(__('dashboard.first_text_en'))
                        ->required(),
                    Forms\Components\MarkdownEditor::make('second_text_ar')
                        ->label(__('dashboard.second_text_ar'))
                        ->required(),
                    Forms\Components\MarkdownEditor::make('second_text_en')
                        ->label(__('dashboard.second_text_en'))
                        ->required(),
                ])->columns(2),
                Forms\Components\Section::make('')->schema([
                    Forms\Components\FileUpload::make('image')
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
                Tables\Columns\TextColumn::make(
                    App::currentLocale() == 'ar' ? 'title_ar' : 'title_en'
                )->label(__('dashboard.title'))
                    ->searchable(),
                Tables\Columns\TextColumn::make(
                    App::currentLocale() == 'ar' ? 'first_text_ar' : 'first_text_en'
                )
                    ->label(__('dashboard.first_text'))
                    ->words(5)
                    ->searchable(),

                Tables\Columns\TextColumn::make(
                    App::currentLocale() == 'ar' ? 'second_text_ar' : 'second_text_en'
                )
                    ->label(__('dashboard.second_text'))
                    ->words(5)
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label(__('dashboard.image')),
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
//                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([

            Section::make('')->schema([
                ImageEntry::make('image')
                    ->label(__('dashboard.image'))->columnSpanFull(),
            ])->columnSpanFull(),

            Section::make(__('dashboard.titles'))->schema([
                TextEntry::make('title_ar')->label(__('dashboard.title_ar')),
                TextEntry::make('title_en')->label(__('dashboard.title_en')),
            ])->columns(2),
            Section::make(__('dashboard.texts'))->schema([
                TextEntry::make('first_text_ar')->label(__('dashboard.first_text_ar')),
                TextEntry::make('first_text_en')->label(__('dashboard.first_text_en')),
                TextEntry::make('second_text_ar')->label(__('dashboard.second_text_ar')),
                TextEntry::make('second_text_en')->label(__('dashboard.second_text_en')),
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
            'index' => Pages\ListAbouts::route('/'),
            'create' => Pages\CreateAbout::route('/create'),
            'view' => Pages\ViewAbout::route('/{record}'),
            'edit' => Pages\EditAbout::route('/{record}/edit'),
        ];
    }
}
