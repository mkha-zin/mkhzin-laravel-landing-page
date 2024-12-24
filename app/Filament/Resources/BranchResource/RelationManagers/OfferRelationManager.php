<?php

namespace App\Filament\Resources\BranchResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\App;

class OfferRelationManager extends RelationManager
{
    protected static string $relationship = 'offer';

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.offers');
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.offers');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.offers');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('dashboard.image'))->schema([
                    Forms\Components\FileUpload::make('image')
                        ->label(__('dashboard.image'))
                        ->directory('assets/images/offers')
                        ->imageEditor()
                        ->image()
                        ->required(),
                    Forms\Components\FileUpload::make('pdf_file')
                        ->acceptedFileTypes(['application/pdf'])
                        ->label(__('dashboard.file'))
                        ->directory('assets/files/offers')
                        ->maxSize(10024)
                        ->required()
                ])->columns(2),
                Forms\Components\Section::make(__(''))->schema([
                    Forms\Components\TextInput::make('name_ar')
                        ->label(__('dashboard.name_ar'))
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('name_en')
                        ->label(__('dashboard.name_en'))
                        ->required()
                        ->maxLength(255),
                ])->columns(2),
                Forms\Components\Section::make(__('dashboard.descriptions'))->schema([
                    Forms\Components\MarkdownEditor::make('description_ar')
                        ->label(__('dashboard.description_ar'))
                        ->required()
                        ->maxLength(255),
                    Forms\Components\MarkdownEditor::make('description_en')
                        ->label(__('dashboard.description_en'))
                        ->required()
                        ->maxLength(255),
                ])->columns(2),

                Forms\Components\Section::make(__('dashboard.duration'))->schema([
                    Forms\Components\DatePicker::make('start_date')
                        ->label(__('dashboard.start_date'))
                        ->required(),
                    Forms\Components\DatePicker::make('end_date')
                        ->label(__('dashboard.end_date'))
                        ->required(),
                ])->columns(2),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make(
                    App::currentLocale() === 'ar' ? 'name_ar' : 'name_en'
                )
                    ->label(__('dashboard.name'))
                    ->searchable(),

                Tables\Columns\TextColumn::make(
                    App::currentLocale() === 'ar' ? 'description_ar' : 'description_en'
                )
                    ->label(__('dashboard.description'))
                    ->words(5)
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label(__('dashboard.image')),
                Tables\Columns\TextColumn::make('pdf_file')
                    ->label(__('dashboard.files'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('start_date')
                    ->label(__('dashboard.start_date'))
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->label(__('dashboard.end_date'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->defaultSort('created_at','desc')
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make('create_new_card')
                    ->authorize(true)
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public  function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([

            Section::make(__('dashboard.image'))->schema([
                ImageEntry::make('image')
                    ->label(__('dashboard.image')),
                TextEntry::make('pdf_file')
                    ->label(__('dashboard.file')),
            ])->columns(2),
            Section::make(__(''))->schema([
                TextEntry::make('name_ar')->label(__('dashboard.name_ar')),
                TextEntry::make('name_en')->label(__('dashboard.name_en')),
            ])->columns(2),
            Section::make(__('dashboard.addresses'))->schema([
                TextEntry::make('address_ar')->label(__('dashboard.address_ar')),
                TextEntry::make('address_en')->label(__('dashboard.address_en')),

            ])->columns(2) ,

            Section::make(__('dashboard.duration'))->schema([
                TextEntry::make('start_date')->label(__('dashboard.start_date')),
                TextEntry::make('end_date')->label(__('dashboard.end_date')),
            ])->columns(2)


        ]);
    }



}
