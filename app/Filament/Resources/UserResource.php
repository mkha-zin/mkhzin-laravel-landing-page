<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Components\UsersForm;
use App\Filament\Resources\UserResource\Components\UsersTable;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.others');
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.admins');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.admins');
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->isSuperAdmin();
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->isSuperAdmin();
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->isSuperAdmin();
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()?->isSuperAdmin();
    }

    public static function form(Form $form): Form
    {
        return UsersForm::form($form);
    }

    public static function table(Table $table): Table
    {
        return UsersTable::table($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
        ];
    }
}
