<?php

namespace App\Filament\Resources\VoucherResource\Pages;

use App\Filament\Resources\VoucherResource;
use App\Models\Voucher;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListVouchers extends ListRecords
{
    protected static string $resource = VoucherResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'All' => Tab::make()
                ->label(__('dashboard.all vouchers'))
                ->badge(Voucher::all()->count()),
            'Used' => Tab::make()
                ->label(__('dashboard.used vouchers'))
                ->modifyQueryUsing(
                    fn(Builder $query) => $query
                        ->where('used', true))
                ->badge(Voucher::query()->where('used', true)->count()),
            'UnUsed' => Tab::make()
                ->label(__('dashboard.unused vouchers'))
                ->modifyQueryUsing(
                    fn(Builder $query) => $query
                        ->where('used', false))
                ->badge(Voucher::query()->where('used', false)->count()),
        ];
    }

}
