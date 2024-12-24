<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SectionResource\Pages;
use App\Models\Section;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use Illuminate\Support\Facades\App;

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
        return __('dashboard.sections');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('dashboard.image'))->schema([
                    Forms\Components\FileUpload::make('image')
                        ->label(__('dashboard.image'))
                        ->directory('assets/images/sections')
                        ->columnSpanFull()
                        ->imageEditor()
                        ->downloadable()
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
                /*Forms\Components\Section::make()->schema([
                    Forms\Components\Toggle::make('show_in_home')
                        ->label(__('dashboard.showInHome'))
                        ->default(false),
                ])->columns(1),*/
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
                Tables\Columns\ImageColumn::make('image')
                    ->label(__('dashboard.image')),
                /*Tables\Columns\IconColumn::make('show_in_home')
                    ->label(__('dashboard.showInHome'))
                    ->boolean()
                ->alignCenter(),*/
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

            \Filament\Infolists\Components\Section::make(__('dashboard.image'))->schema([
                ImageEntry::make('image')
                    ->label(__('dashboard.image')),

            ])->columns(2),
            \Filament\Infolists\Components\Section::make(__('dashboard.titles'))->schema([
                TextEntry::make('title_ar')->label(__('dashboard.title_ar')),
                TextEntry::make('title_en')->label(__('dashboard.title_en')),
            ])->columns(2),
            \Filament\Infolists\Components\Section::make(__('dashboard.descriptions'))->schema([
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
            'index' => Pages\ListSections::route('/'),
            'create' => Pages\CreateSection::route('/create'),
            'view' => Pages\ViewSection::route('/{record}'),
            'edit' => Pages\EditSection::route('/{record}/edit'),
        ];
    }
}
