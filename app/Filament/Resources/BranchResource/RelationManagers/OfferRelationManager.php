<?php

namespace App\Filament\Resources\BranchResource\RelationManagers;

use App\Models\Offer;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section as InfoSection;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\App;

class OfferRelationManager extends RelationManager
{
    protected static string $relationship = 'offer';

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.offers');
    }

    public static function getTitle(Model $ownerRecord, string $pageClass): string
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
                Section::make(__('dashboard.Image'))->schema([
                    FileUpload::make('image')
                        ->label(__('dashboard.Image'))
                        ->directory('assets/images/offers')
                        ->imageEditor()
                        ->image()
                        ->required(),
                    FileUpload::make('pdf_file')
                        ->helperText(__('dashboard.Only Compressed files are allowed'))
                        ->label(__('dashboard.file'))
                        ->getUploadedFileNameForStorageUsing(function (UploadedFile $file, ?Offer $record) {
                            if ($record) {
                                return 'offer-' . $record->id . '-' . $record->name_en . '-' . $file->getClientOriginalName();
                            }
                            return $file->getClientOriginalName();
                        })
                        ->directory('zips')
                        ->disk('zip')
                        ->acceptedFileTypes(['zip', 'application/octet-stream', 'application/zip', 'application/x-zip', 'application/x-zip-compressed'])
                        ->maxSize(50072)
                        ->downloadable()
                        ->required()
                ])->columns(2),
                Section::make(__(''))->schema([
                    TextInput::make('name_ar')
                        ->label(__('dashboard.name_ar'))
                        ->required()
                        ->maxLength(255),
                    TextInput::make('name_en')
                        ->label(__('dashboard.name_en'))
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

                Section::make(__('dashboard.duration'))->schema([
                    DatePicker::make('start_date')
                        ->label(__('dashboard.start_date'))
                        ->required(),
                    DatePicker::make('end_date')
                        ->label(__('dashboard.end_date'))
                        ->required(),
                    Toggle::make('is_active')
                        ->label(__('dashboard.status')),
                ])->columns(3),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make(
                    App::currentLocale() === 'ar' ? 'name_ar' : 'name_en'
                )
                    ->label(__('dashboard.name'))
                    ->searchable(),

                TextColumn::make(
                    App::currentLocale() === 'ar' ? 'description_ar' : 'description_en'
                )
                    ->label(__('dashboard.description'))
                    ->words(5)
                    ->searchable(),
                ImageColumn::make('image')
                    ->label(__('dashboard.Image')),
                TextColumn::make('pdf_file')
                    ->label(__('dashboard.files'))
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('start_date')
                    ->label(__('dashboard.start_date'))
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make('end_date')
                    ->label(__('dashboard.end_date'))
                    ->date()
                    ->dateTimeTooltip('Y/m/d h:i:s A')
                    ->sortable(),
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
            ])->defaultSort('created_at', 'desc')
            ->headerActions([
                CreateAction::make('create_new_card')
                    ->authorize(true)
            ])
            ->actions([
                ViewAction::make(),
            ]);
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([

            InfoSection::make(__('dashboard.Image'))->schema([
                ImageEntry::make('image')
                    ->label(__('dashboard.Image')),
                TextEntry::make('pdf_file')
                    ->label(__('dashboard.file')),
            ])->columns(2),
            InfoSection::make(__(''))->schema([
                TextEntry::make('name_ar')->label(__('dashboard.name_ar')),
                TextEntry::make('name_en')->label(__('dashboard.name_en')),
            ])->columns(2),
            InfoSection::make(__('dashboard.addresses'))->schema([
                TextEntry::make('address_ar')->label(__('dashboard.address_ar')),
                TextEntry::make('address_en')->label(__('dashboard.address_en')),

            ])->columns(2),

            InfoSection::make(__('dashboard.duration'))->schema([
                TextEntry::make('start_date')->label(__('dashboard.start_date')),
                TextEntry::make('end_date')->label(__('dashboard.end_date')),
            ])->columns(2)
        ]);
    }

}
