<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactImageResource\Pages;
use App\Models\ContactImage;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
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

class ContactImageResource extends Resource
{
    protected static ?string $model = ContactImage::class;


    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.contactSettings');
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.contactImages');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.contactImages');
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
                FileUpload::make('image')
                    ->label(__('dashboard.Image'))
                    ->directory('assets/images/contactImages')
                    ->image()
                    ->imageEditor()
                    ->columnSpanFull()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label(__('dashboard.Image')),

                TextColumn::make(
                    App::currentLocale() === 'ar' ? 'view_title_ar' : 'view_title_en'
                )
                    ->label(__('dashboard.title'))
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label(__('dashboard.created at'))
                    ->date()
                    ->dateTimeTooltip('Y/m/d h:i:s A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('dashboard.updated at'))
                    ->date()
                    ->dateTimeTooltip('Y/m/d h:i:s A')
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

            Section::make()->schema([
                ImageEntry::make('image')->label(__('dashboard.Image')),
                TextEntry::make(
                    App::currentLocale() === 'ar' ? 'view_title_ar' : 'view_title_en'
                )->label(__('dashboard.title')),
            ])->columns(2),


        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactImages::route('/'),
        ];
    }
}
