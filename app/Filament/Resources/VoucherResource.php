<?php

namespace App\Filament\Resources;

use App\Filament\Exports\VoucherExporter;
use App\Filament\Resources\VoucherResource\Pages;
use App\Models\Voucher;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Actions\Exports\Models\Export;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use LaraZeus\Delia\Filament\Actions\BookmarkHeaderAction;

class VoucherResource extends Resource
{
    protected static ?string $model = Voucher::class;

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.others');
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.vouchers');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.voucher1');
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->isSuperAdmin();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('dashboard.voucher details'))
                    ->collapsible()
                    ->schema([
                        TextInput::make('voucher')
                            ->label(__('dashboard.voucher'))
                            ->unique()
                            ->required()
                            ->maxLength(255),
                        Toggle::make('used')
                            ->label(__('dashboard.Used'))
                            ->required(),
                    ])->columns(2),

                Section::make(__('dashboard.beneficiary details'))
                    ->collapsible()
                    ->collapsed()
                    ->schema([
                        TextInput::make('c_name')
                            ->label(__('dashboard.customer name'))
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->label(__('dashboard.customer phone'))
                            ->maxLength(255),
                        DateTimePicker::make('using_date')
                            ->label(__('dashboard.using_date')),
                    ])->columns(3),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('id')
            ->striped()
            ->columns([
                TextColumn::make('id')
                    ->label('#')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('voucher')
                    ->label(__('dashboard.voucher'))
                    ->searchable()
                    ->badge()
                    ->copyable()
                    ->copyMessage(__('dashboard.Copied!'))
                    ->copyMessageDuration(1500),
                IconColumn::make('used')
                    ->label(__('dashboard.Used'))
                    ->boolean()
                    ->sortable(),
                TextColumn::make('c_name')
                    ->label(__('dashboard.customer name'))
                    ->searchable(),
                TextColumn::make('phone')
                    ->label(__('dashboard.customer phone'))
                    ->searchable(),
                TextColumn::make('using_date')
                    ->label(__('dashboard.using_date'))
                    ->date()
                    ->dateTimeTooltip(format: 'Y/m/d h:i:s a')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label(__('dashboard.created at'))
                    ->date()
                    ->dateTimeTooltip('Y/m/d h:i:s A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make(__('dashboard.updated at'))
                    ->date()
                    ->dateTimeTooltip('Y/m/d h:i:s A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                ExportBulkAction::make()
                    ->exporter(VoucherExporter::class)
                    ->formats([
                        ExportFormat::Xlsx,
                    ])
                    ->fileDisk('public')
                    ->icon('heroicon-o-arrow-down-circle')
                    ->fileName(fn(Export $export): string => "vouchers-{$export->getKey()}"),
                BulkAction::make('exports')
                    ->label(__('dashboard.exports'))
                    ->icon('heroicon-o-newspaper')
                    ->url('exports')
                    ->color('primary')
                    ->openUrlInNewTab(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVouchers::route('/'),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            BookmarkHeaderAction::make()
        ];
    }
}
