<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BranchResource\Components\BranchForm;
use App\Filament\Resources\BranchResource\Components\BranchInfolist;
use App\Filament\Resources\BranchResource\Components\BranchTable;
use App\Filament\Resources\BranchResource\Pages;
use App\Filament\Resources\BranchResource\RelationManagers\OfferRelationManager;
use App\Filament\Resources\BranchResource\RelationManagers\ReviewsRelationManager;
use App\Models\Branch;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class BranchResource extends Resource
{
    protected static ?string $model = Branch::class;
    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.servicesManagement');
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.branches');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.branches');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return BranchForm::form($form);
    }

    public static function table(Table $table): Table
    {
        return BranchTable::table($table);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return BranchInfolist::infolist($infolist);
    }

    public static function getRelations(): array
    {
        return [
            OfferRelationManager::class,
            ReviewsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBranches::route('/'),
            'create' => Pages\CreateBranch::route('/create'),
            'view' => Pages\ViewBranch::route('/{record}'),
            'edit' => Pages\EditBranch::route('/{record}/edit'),
        ];
    }
}
