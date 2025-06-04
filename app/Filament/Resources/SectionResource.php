<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SectionResource\Components\SectionForm;
use App\Filament\Resources\SectionResource\Components\SectionInfolist;
use App\Filament\Resources\SectionResource\Components\SectionTable;
use App\Filament\Resources\SectionResource\Pages;
use App\Models\Section;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use LaraZeus\Delia\Filament\Actions\BookmarkHeaderAction;

class SectionResource extends Resource
{
    protected static ?string $model = Section::class;

    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.servicesManagement');
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.sections');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.section');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getRecordTitleAttribute(): ?string
    {
        return App::currentLocale() === 'ar' ? 'title_ar' : 'title_en';
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title_ar', 'title_en', 'description_ar', 'description_en'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            __('dashboard.name') => App::currentLocale() === 'ar' ? $record->title_ar : $record->title_en,
            __('dashboard.description') => App::currentLocale() === 'ar' ? $record->description_ar : $record->description_en,
        ];
    }

    public static function form(Form $form): Form
    {
        return SectionForm::form($form);
    }

    public static function table(Table $table): Table
    {
        return SectionTable::table($table);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return SectionInfolist::infolist($infolist);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSections::route('/'),
            'create' => Pages\CreateSection::route('/create'),
            'view' => Pages\ViewSection::route('/{record}'),
            'edit' => Pages\EditSection::route('/{record}/edit'),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            BookmarkHeaderAction::make()
        ];
    }
}
