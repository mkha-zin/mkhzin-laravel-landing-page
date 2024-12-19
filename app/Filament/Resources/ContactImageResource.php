<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactImageResource\Pages;
use App\Filament\Resources\ContactImageResource\RelationManagers;
use App\Models\ContactImage;
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
                Forms\Components\FileUpload::make('image')
                    ->label(__('dashboard.image'))
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
                Tables\Columns\ImageColumn::make('image')
                    ->label(__('dashboard.image')),

                Tables\Columns\TextColumn::make(
                    App::currentLocale() == 'ar' ? 'view_title_ar' : 'view_title_en'
                )
                    ->label(__('dashboard.title'))
                    ->searchable(),
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
            ])
            ->bulkActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([

            Section::make()->schema([
                ImageEntry::make('image')->label(__('dashboard.image')),
                TextEntry::make(
                    App::currentLocale() == 'ar' ? 'view_title_ar' : 'view_title_en'
                )->label(__('dashboard.title')),
            ])->columns(2),



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
            'index' => Pages\ListContactImages::route('/'),
            'create' => Pages\CreateContactImage::route('/create'),
            'view' => Pages\ViewContactImage::route('/{record}'),
            'edit' => Pages\EditContactImage::route('/{record}/edit'),
        ];
    }
}
