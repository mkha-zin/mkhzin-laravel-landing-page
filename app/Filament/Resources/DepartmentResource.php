<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepartmentResource\Components\DepartmentForm;
use App\Filament\Resources\DepartmentResource\Components\DepartmentTable;
use App\Filament\Resources\DepartmentResource\Pages;
use App\Models\Department;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class DepartmentResource extends Resource
{
    protected static ?string $model = Department::class;

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.servicesManagement');
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.departments');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.department');
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function getRecordTitleAttribute(): ?string
    {
        return App::currentLocale() === 'ar' ? 'title_ar' : 'title_en';
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title_ar', 'title_en', 'description_ar', 'description_en', 'tags_ar', 'tags_en'];
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
        return DepartmentForm::form($form);
    }

    public static function table(Table $table): Table
    {
        return DepartmentTable::table($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDepartments::route('/'),
        ];
    }
}
