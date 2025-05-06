<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BranchResource\Pages;
use App\Models\Branch;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
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
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\App;

class BranchResource extends Resource
{
    protected static ?string $model = Branch::class;
    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.servicesManagement');
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.branches');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.branches');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Select::make('city_id')
                        ->relationship('city',
                            App::currentLocale() === 'ar' ? 'name_ar' : 'name_en')
                        ->default(null),
                    Select::make('type')
                        ->label(__('dashboard.type'))
                        ->options([
                            'super' => __('dashboard.super'),
                            'hyper' => __('dashboard.hyper'),
                            'wholesale' => __('dashboard.wholesale'),
                        ]),
                ])->columns(2),
                Section::make([
                    TextInput::make('name_ar')
                        ->label(__('dashboard.name_ar'))
                        ->required()
                        ->maxLength(255),
                    TextInput::make('name_en')
                        ->label(__('dashboard.name_en'))
                        ->required()
                        ->maxLength(255),
                    MarkdownEditor::make('description_ar')
                        ->label(__('dashboard.description_ar'))
                        ->required(),
                    MarkdownEditor::make('description_en')
                        ->label(__('dashboard.description_en'))
                        ->required(),
                ])->columns(2),
                Section::make(__('dashboard.addresses'))->schema([
                    TextInput::make('address_ar')
                        ->label(__('dashboard.address_ar'))
                        ->required()
                        ->maxLength(255),
                    TextInput::make('address_en')
                        ->label(__('dashboard.address_en'))
                        ->required()
                        ->maxLength(255),
                    TextInput::make('longitude')
                        ->label(__('dashboard.longitude'))
                        ->required(),
                    TextInput::make('latitude')
                        ->label(__('dashboard.latitude'))
                        ->required(),
                ])->columns(2),
                Section::make(__('dashboard.social_link'))->schema([
                    TextInput::make('snapchat')
                        ->label(__('dashboard.snapchat'))
                        ->suffixIcon('heroicon-s-link')
                        ->url()
                        ->required(),
                    TextInput::make('instagram')
                        ->label(__('dashboard.instagram'))
                        ->suffixIcon('heroicon-s-link')
                        ->url()
                        ->required(),
                    TextInput::make('tiktok')
                        ->label(__('dashboard.tiktok'))
                        ->suffixIcon('heroicon-s-link')
                        ->url()
                        ->required(),
                ])->columns(3),
                Section::make(__('dashboard.files'))->schema([
                    FileUpload::make('image')
                        ->label(__('dashboard.image'))
                        ->directory('assets/images/branches')
                        ->imageEditor()
                        ->image()
                        ->required(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make(
                    App::currentLocale() === 'ar' ? 'city.name_ar' : 'city.name_en'
                )
                    ->label(__('dashboard.city'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make(
                    App::currentLocale() === 'ar' ? 'name_ar' : 'name_en'
                )
                    ->label(__('dashboard.name'))
                    ->searchable(),
                TextColumn::make('type')
                    ->label(__('dashboard.type'))
                    ->searchable()
                    ->badge()
                    ->formatStateUsing(function ($record) {
                        return $record->type === 'super'
                            ? __('dashboard.super')
                            : ($record->type === 'hyper'
                                ? __('dashboard.hyper')
                                : __('dashboard.wholesale'));
                    })
                    ->alignCenter()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make(
                    App::currentLocale() === 'ar' ? 'description_ar' : 'description_en'
                )
                    ->label(__('dashboard.description'))
                    ->words(5)
                    ->searchable()
                    ->toggleable(),
                TextColumn::make(
                    App::currentLocale() === 'ar' ? 'address_ar' : 'address_en'
                )
                    ->label(__('dashboard.address'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('snapchat')
                    ->label(__('dashboard.snapchat'))
                    ->icon(asset('images/icons/snapchat.png'))
                    ->alignCenter()
                    ->url(fn($record) => filled($record->snapchat) ? $record->snapchat : null, shouldOpenInNewTab: true)
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('instagram')
                    ->label(__('dashboard.instagram'))
                    ->icon(asset('images/icons/instagram.png'))
                    ->alignCenter()
                    ->url(fn($record) => filled($record->instagram) ? $record->instagram : null, shouldOpenInNewTab: true)
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('tiktok')
                    ->label(__('dashboard.tiktok'))
                    ->icon(asset('images/icons/tik-tok.png'))
                    ->alignCenter()
                    ->url(fn($record) => filled($record->tiktok) ? $record->tiktok : null, shouldOpenInNewTab: true)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('longitude')
                    ->label(__('dashboard.coordinates'))
                    ->description(fn(Branch $record) => $record->latitude)
                    ->toggleable(isToggledHiddenByDefault: true),
                ImageColumn::make('image')
                    ->label(__('dashboard.image'))
                    ->alignCenter()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                ViewAction::make()->iconButton()->icon('heroicon-o-building-storefront'),
                EditAction::make()->iconButton(),
                DeleteAction::make()->iconButton(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([

            InfoSection::make(__('dashboard.details'))->schema([
                ImageEntry::make('image')
                    ->label(__('dashboard.image')),
                TextEntry::make(
                    App::currentLocale() === 'ar' ? 'city.name_ar' : 'city.name_en'
                )->label(__('dashboard.city')),
                TextEntry::make('type')->label(__('dashboard.type')),
            ])->columns(3),
            InfoSection::make(__(''))->schema([
                TextEntry::make('name_ar')->label(__('dashboard.name_ar')),
                TextEntry::make('name_en')->label(__('dashboard.name_en')),
                TextEntry::make('description_ar')->label(__('dashboard.description_ar'))->markdown(),
                TextEntry::make('description_en')->label(__('dashboard.description_en'))->markdown(),
            ])->columns(2),
            InfoSection::make(__('dashboard.addresses'))->schema([
                TextEntry::make('address_ar')->label(__('dashboard.address_ar')),
                TextEntry::make('address_en')->label(__('dashboard.address_en')),
                TextEntry::make('longitude')->label(__('dashboard.longitude')),
                TextEntry::make('latitude')->label(__('dashboard.latitude')),
            ])->columns(2),
            InfoSection::make(__('dashboard.social_link'))->schema([
                TextEntry::make('snapchat')
                    ->label(__('dashboard.snapchat'))
                    ->url(fn(Branch $record) => $record->snapchat, true),
                TextEntry::make('instagram')
                    ->label(__('dashboard.instagram'))
                    ->url(fn(Branch $record) => $record->instagram, true),
                TextEntry::make('tiktok')
                    ->label(__('dashboard.tiktok'))
                    ->url(fn(Branch $record) => $record->tiktok, true),
            ])->columns(3),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBranches::route('/'),
            'create' => Pages\CreateBranch::route('/create'),
            'view' => Pages\ViewBranch::route('/{record}'),
            'edit' => Pages\EditBranch::route('/{record}/edit'),
        ];
    }
}
