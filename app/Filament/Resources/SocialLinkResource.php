<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocialLinkResource\Pages;
use App\Models\SocialLink;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
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
                TextInput::make('title_ar')
                    ->label(__('dashboard.title_ar'))
                    ->required(),
                TextInput::make('title_en')
                    ->label(__('dashboard.title_en'))
                    ->required(),
                TextInput::make('link')
                    ->label(__('dashboard.link'))
                    ->required()
                    ->url()
                    ->columnSpanFull(),
                TextInput::make('comment_en')
                    ->label(__('dashboard.comment_en'))
                    ->maxValue(255),
                TextInput::make('comment_ar')
                    ->label(__('dashboard.comment_ar'))
                    ->maxValue(255),
                Toggle::make('is_active')
                    ->label(__('dashboard.status')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make(
                    App::currentLocale() === 'ar' ? 'title_ar' : 'title_en'
                )
                    ->label(__('dashboard.title'))
                    ->searchable(),
                TextColumn::make('link')
                    ->label(__('dashboard.link'))
                    ->limit(20)
                    ->searchable(),
                TextColumn::make(
                    App::currentLocale() === 'ar' ? 'comment_ar' : 'comment_en'
                )
                    ->limit(30)
                    ->label(__('dashboard.comment')),
                CheckboxColumn::make('is_active')
                    ->label(__('dashboard.status')),
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
                DeleteAction::make(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSocialLinks::route('/'),
        ];
    }
}
