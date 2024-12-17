<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfferResource\Pages;
use App\Filament\Resources\OfferResource\RelationManagers;
use App\Models\Offer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ReplicateAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\App;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class OfferResource extends Resource
{
    protected static ?string $model = Offer::class;
    protected static ?int $navigationSort = 3;

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.servicesManagement');
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.offers');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.offers');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([
                    Forms\Components\Select::make('branch_id')
                        ->label(__('dashboard.branch'))
                        ->relationship('branch',
                            App::currentLocale() == 'ar' ? 'name_ar' : 'name_en'
                        )
                        ->columnSpanFull()
                        ->required(),
                ])->columns(2),

                Forms\Components\Section::make(__('dashboard.files'))->schema([
                    Forms\Components\FileUpload::make('image')
                        ->label(__('dashboard.image'))
                        ->directory('assets/images/offers')
                        ->imageEditor()
                        ->image()
                        ->required(),
                    Forms\Components\FileUpload::make('pdf_file')
                        ->helperText('Only zip files are allowed') // TODO: translate this & restrict file types

                        ->label(__('dashboard.file'))
                        ->getUploadedFileNameForStorageUsing(function (UploadedFile $file, ?Offer $record) {
                            if ($record) {
                                return 'offer-' . $record->id . '-' . $record->name_en . '-' . $file->getClientOriginalName();
                            }
                            return $file->getClientOriginalName();
                        })
                        ->directory('zips')
                        ->disk('zip')
                        ->acceptedFileTypes(['zip','application/octet-stream','application/zip','application/x-zip','application/x-zip-compressed'])
                        ->maxSize(30072)
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
                        ->required(),
                    Forms\Components\MarkdownEditor::make('description_en')
                        ->label(__('dashboard.description_en'))
                        ->required(),
                ])->columns(2),

                Forms\Components\Section::make(
                    __('dashboard.duration')
                )->schema([
                    Forms\Components\DatePicker::make('start_date')
                        ->label(__('dashboard.start_date'))
                        ->required(),
                    Forms\Components\DatePicker::make('end_date')
                        ->label(__('dashboard.end_date'))
                        ->required(),
                ])->columns(2),

                Forms\Components\Toggle::make('is_active')
                    ->label(__('dashboard.status')),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make(
                    App::currentLocale() == 'ar' ? 'name_ar' : 'name_en'
                )
                    ->label(__('dashboard.name'))
                    ->searchable(),

                Tables\Columns\TextColumn::make(
                    App::currentLocale() == 'ar' ? 'description_ar' : 'description_en'
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
                Tables\Columns\CheckboxColumn::make('is_active')
                    ->label(__('dashboard.status')),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
                ReplicateAction::make()
                    ->excludeAttributes(['is_active'])
                    ->form([
                        Forms\Components\Section::make()->schema([
                            Forms\Components\Select::make('branch_id')
                                ->label(__('dashboard.branch'))
                                ->relationship('branch',
                                    App::currentLocale() == 'ar' ? 'name_ar' : 'name_en'
                                )
                                ->columnSpanFull()
                                ->required(),
                        ])->columns(2),

                        Forms\Components\Section::make(__('dashboard.files'))
                            ->collapsible()
                            ->collapsed()
                            ->schema([
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
                                ->maxSize(30072)
                                ->required()
                        ])->columns(2),
                        Forms\Components\Section::make(__('dashboard.title'))
                            ->collapsible()
                            ->collapsed()
                            ->schema([
                            Forms\Components\TextInput::make('name_ar')
                                ->label(__('dashboard.name_ar'))
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TextInput::make('name_en')
                                ->label(__('dashboard.name_en'))
                                ->required()
                                ->maxLength(255),
                        ])->columns(2),
                        Forms\Components\Section::make(__('dashboard.descriptions'))
                            ->collapsible()
                            ->collapsed()
                            ->schema([
                            Forms\Components\MarkdownEditor::make('description_ar')
                                ->label(__('dashboard.description_ar'))
                                ->required(),
                            Forms\Components\MarkdownEditor::make('description_en')
                                ->label(__('dashboard.description_en'))
                                ->required(),
                        ])->columns(2),

                        Forms\Components\Section::make(
                            __('dashboard.duration')
                        )->schema([
                            Forms\Components\DatePicker::make('start_date')
                                ->label(__('dashboard.start_date'))
                                ->required(),
                            Forms\Components\DatePicker::make('end_date')
                                ->label(__('dashboard.end_date'))
                                ->required(),
                        ])->columns(2),

                        Forms\Components\Toggle::make('is_active')
                            ->label(__('dashboard.status')),
                    ])
                    ->beforeReplicaSaved(function (Model $replica, array $data): void {
                        $replica->fill($data);
                    })
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

            Section::make()->schema([
                TextEntry::make(
                    App::currentLocale() == 'ar' ? 'branch.name_ar' : 'branch.name_en'
                )->label(__('dashboard.branch')),
            ])->columns(2),
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
            Section::make(__('dashboard.description'))->schema([
                TextEntry::make('description_ar')->label(__('dashboard.description_ar')),
                TextEntry::make('description_en')->label(__('dashboard.description_en')),

            ])->columns(2),

            Section::make(__('dashboard.duration'))->schema([
                TextEntry::make('start_date')->label(__('dashboard.start_date')),
                TextEntry::make('end_date')->label(__('dashboard.end_date')),
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
            'index' => Pages\ListOffers::route('/'),
            'create' => Pages\CreateOffer::route('/create'),
            'view' => Pages\ViewOffer::route('/{record}'),
            'edit' => Pages\EditOffer::route('/{record}/edit'),
        ];
    }
}
