<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocialLinkResource\Pages;
use App\Filament\Resources\SocialLinkResource\RelationManagers;
use App\Models\SocialLink;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class SocialLinkResource extends Resource
{
    protected static ?string $model = SocialLink::class;


    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.contactSettings');
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.social_link');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.social_link');
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
                Forms\Components\TextInput::make('title_ar')
                    ->label(__('dashboard.title_ar'))
                    ->required(),
                Forms\Components\TextInput::make('title_en')
                    ->label(__('dashboard.title_en'))
                    ->required(),
                Forms\Components\TextInput::make('link')
                    ->label(__('dashboard.link'))
                    ->required()
                    ->url()
                ->columnSpanFull(),
                Forms\Components\TextInput::make('comment_en')
                    ->label(__('dashboard.comment_en'))
                    ->maxValue(255),
                Forms\Components\TextInput::make('comment_ar')
                    ->label(__('dashboard.comment_ar'))
                    ->maxValue(255),
                Forms\Components\Toggle::make('is_active')
                    ->label(__('dashboard.status')),
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
                    ->searchable(),
                Tables\Columns\TextColumn::make('link')
                    ->label(__('dashboard.link'))
                    ->searchable(),
                Tables\Columns\TextColumn::make(
                    App::currentLocale() === 'ar' ? 'comment_ar' : 'comment_en'
                )
                    ->label(__('dashboard.comment')),
                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('dashboard.status'))
                    ->boolean(),
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
                Tables\Actions\DeleteAction::make(),
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
            TextEntry::make('title_ar')->label(__('dashboard.title_ar')),
            TextEntry::make('title_en')->label(__('dashboard.title_en')),
            TextEntry::make('link')->label(__('dashboard.link')),
            TextEntry::make('comment_en')->label(__('dashboard.comment')),
            TextEntry::make('comment_ar')->label(__('dashboard.comment')),
            IconEntry::make('is_active')->label(__('dashboard.is_active'))->boolean(),
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
            'index' => Pages\ListSocialLinks::route('/'),
            'create' => Pages\CreateSocialLink::route('/create'),
            'view' => Pages\ViewSocialLink::route('/{record}'),
            'edit' => Pages\EditSocialLink::route('/{record}/edit'),
        ];
    }
}
