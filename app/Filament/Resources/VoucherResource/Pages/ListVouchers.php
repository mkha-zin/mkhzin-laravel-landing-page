<?php

namespace App\Filament\Resources\VoucherResource\Pages;

use App\Filament\Resources\VoucherResource;
use App\Models\Voucher;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Colors\Color;
use Illuminate\Database\Eloquent\Builder;

class ListVouchers extends ListRecords
{
    protected static string $resource = VoucherResource::class;

    public function getTabs(): array
    {
        return [
            'All' => Tab::make()
                ->label(__('dashboard.all vouchers'))
                ->extraAttributes([
                    'style' => 'min-width: 140px',
                ])
                ->badge(Voucher::all()->count())
                ->badgeColor(Color::Blue),
            'Used' => Tab::make()
                ->label(__('dashboard.used vouchers'))
                ->extraAttributes([
                    'style' => 'min-width: 180px',
                ])
                ->modifyQueryUsing(
                    fn(Builder $query) => $query
                        ->where('used', true))
                ->badge(Voucher::query()->where('used', true)->count())
                ->badgeColor(Color::Red),
            'UnUsed' => Tab::make()
                ->label(__('dashboard.unused vouchers'))
                ->extraAttributes([
                    'style' => 'min-width: 210px',
                ])
                ->modifyQueryUsing(
                    fn(Builder $query) => $query
                        ->where('used', false))
                ->badge(Voucher::query()->where('used', false)->count())
                ->badgeColor(Color::Green),

        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
