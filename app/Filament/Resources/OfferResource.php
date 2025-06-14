<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfferResource\Components\OffersForm;
use App\Filament\Resources\OfferResource\Components\OffersInfolist;
use App\Filament\Resources\OfferResource\Components\OffersTable;
use App\Filament\Resources\OfferResource\Pages;
use App\Models\Offer;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use LaraZeus\Delia\Filament\Actions\BookmarkHeaderAction;

class OfferResource extends Resource
{
    protected static ?string $model = Offer::class;
    protected static ?int $navigationSort = 3;

    public static function canAccess(): bool
    {
        if (auth()->user()->role !== 'super') {
            abort(403, 'You do not have access to this page.');
        }
        return parent::canAccess(); // TODO: Change the autogenerated stub
    }

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.servicesManagement');
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.offers');
    }

    public static function getRecordTitleAttribute(): ?string
    {
        return App::currentLocale() === 'ar' ? 'name_ar' : 'name_en';
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name_ar', 'name_en', 'description_ar', 'description_en'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            __('dashboard.name') => App::currentLocale() === 'ar' ? $record->name_ar : $record->name_en,
            __('dashboard.description') => App::currentLocale() === 'ar' ? $record->description_ar : $record->description_en,
        ];
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.offers');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function table(Table $table): Table
    {
        return OffersTable::table($table);
    }

    public static function form(Form $form): Form
    {
        return OffersForm::form($form);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return OffersInfolist::infolist($infolist);
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

    protected function getHeaderActions(): array
    {
        return [
            BookmarkHeaderAction::make()
        ];
    }
}
