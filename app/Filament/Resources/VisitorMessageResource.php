<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VisitorMessageResource\Pages;
use App\Models\VisitorMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class VisitorMessageResource extends Resource
{
    protected static ?string $model = VisitorMessage::class;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.contactSettings');
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.visitor_message');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.visitor_message');
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getRecordTitleAttribute(): ?string
    {
        return 'first_name';
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['first_name', 'last_name', 'email', 'phone', 'subject', 'message',];
    }


    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            __('dashboard.name') => $record->first_name . ' ' . $record->last_name,
            __('dashboard.email') => $record->email,
            __('dashboard.phone') => $record->phone,
            __('dashboard.subject') => $record->subject,
            __('dashboard.message') => $record->message,
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('last_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('subject')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('message')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->label(__('dashboard.first_name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->label(__('dashboard.last_name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('dashboard.email'))
                    ->limit(20)
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label(__('dashboard.phone'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject')
                    ->label(__('dashboard.subject'))
                    ->words(5)
                    ->searchable(),
                Tables\Columns\TextColumn::make('message')
                    ->words(5)
                    ->label(__('dashboard.message'))
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
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([

            Section::make(__('dashboard.details'))->schema([
                TextEntry::make('first_name')->label(__('dashboard.first_name')),
                TextEntry::make('last_name')->label(__('dashboard.last_name')),
            ])->columns(2),
            Section::make(__('dashboard.contact_info'))->schema([
                TextEntry::make('phone')->label(__('dashboard.phone')),
                TextEntry::make('email')->label(__('dashboard.email')),
            ])->columns(2),
            Section::make(__('dashboard.subject_and_message'))->schema([
                TextEntry::make('subject')->label(__('dashboard.subject')),
                TextEntry::make('message')->label(__('dashboard.message')),
            ])->columns(1)


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
            'index' => Pages\ListVisitorMessages::route('/'),
            'create' => Pages\CreateVisitorMessage::route('/create'),
            'view' => Pages\ViewVisitorMessage::route('/{record}'),
            'edit' => Pages\EditVisitorMessage::route('/{record}/edit'),
        ];
    }
}
