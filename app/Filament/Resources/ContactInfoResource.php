<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactInfoResource\Pages;
use App\Models\ContactInfo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class ContactInfoResource extends Resource
{
    protected static ?string $model = ContactInfo::class;


    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.contactSettings');
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.contact_info');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.contact_info');
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('action_id')
                    ->label(__('dashboard.action'))
                    ->relationship('action',
                        App::currentLocale() === 'ar' ? 'name_ar' : 'name_en'
                    )
                    ->disabled()
                    ->required(),
                Forms\Components\TextInput::make('content')
                    ->label(__('dashboard.content'))
                    ->hint(__('dashboard.content_hint'))
                    ->required()
                    ->maxLength(255),
/*                Forms\Components\FileUpload::make('icon')
                    ->directory('assets/icons')
                    ->label(__('dashboard.icon'))
                    ->required()
                    ->imageEditor()
                    ->image()
                    ->columnSpanFull(),*/
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make(
                    App::currentLocale() === 'ar' ? 'action.name_ar' : 'action.name_en'
                )
                    ->numeric()
                    ->sortable(),
/*                Tables\Columns\TextColumn::make('icon')
                    ->label(__('dashboard.icon'))
                    ->searchable(),*/
                Tables\Columns\TextColumn::make('content')
                    ->label(__('dashboard.content'))
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
                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            /*Section::make()->schema([
                ImageEntry::make('icon')
                    ->label(__('dashboard.icon')),
            ])->columns(2),*/
            Section::make(__('dashboard.details'))->schema([
                TextEntry::make('content')->label(__('dashboard.content')),
                TextEntry::make(
                    App::currentLocale() === 'ar' ? 'action.name_ar' : 'action.name_en'
                )->label(__('dashboard.action')),
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
            'index' => Pages\ListContactInfos::route('/'),
            'create' => Pages\CreateContactInfo::route('/create'),
            'view' => Pages\ViewContactInfo::route('/{record}'),
            'edit' => Pages\EditContactInfo::route('/{record}/edit'),
        ];
    }
}
