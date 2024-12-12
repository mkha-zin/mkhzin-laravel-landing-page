<?php

namespace App\Filament\Resources;

use App\Filament\Exports\VoucherExporter;
use App\Filament\Resources\VoucherResource\Pages;
use App\Filament\Resources\VoucherResource\RelationManagers;
use App\Models\Voucher;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Actions\Exports\Models\Export;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('dashboard.voucher details'))
                    ->collapsible()
                    ->schema([
                    Forms\Components\TextInput::make('voucher')
                        ->label(__('dashboard.voucher'))
                        ->unique()
                        ->required()
                        ->maxLength(255),
                    Forms\Components\Toggle::make('used')
                        ->label(__('dashboard.Used'))
                        ->required(),
                ])->columns(2),

                Forms\Components\Section::make(__('dashboard.beneficiary details'))
                    ->collapsible()
                    ->collapsed()
                    ->schema([
                    Forms\Components\TextInput::make('c_name')
                        ->label(__('dashboard.customer name'))
                        ->maxLength(255),
                    Forms\Components\TextInput::make('phone')
                        ->label(__('dashboard.customer phone'))
                        ->maxLength(255),
                    Forms\Components\DateTimePicker::make('using_date')
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
                Tables\Columns\TextColumn::make('id')
                    ->label('#')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('voucher')
                    ->label(__('dashboard.voucher'))
                    ->searchable()
                    ->badge()
                    ->copyable()
                    ->copyMessage(__('dashboard.Copied!'))
                    ->copyMessageDuration(1500),
                Tables\Columns\IconColumn::make('used')
                    ->label(__('dashboard.Used'))
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('c_name')
                    ->label(__('dashboard.customer name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label(__('dashboard.customer phone'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('using_date')
                    ->label(__('dashboard.using_date'))
                    ->date()
                    ->dateTimeTooltip()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('dashboard.created_at'))
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
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ExportBulkAction::make()
                        ->exporter(VoucherExporter::class)
                        ->formats([
                            ExportFormat::Xlsx,
                            ExportFormat::Csv,
                        ])
                        ->fileDisk('local')
                        ->fileName(fn (Export $export): string => "vouchers-{$export->getKey()}.csv")
                        ->successNotification(
                            Notification::make()
                                ->title(__('dashboard.voucher exported successfully'))
                                ->success()
                                ->body(__('dashboard.you can download it from your computer'))
                                ->duration(1500)
                                ->send()
                        )
                ]),
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
            'index' => Pages\ListVouchers::route('/'),
/*            'create' => Pages\CreateVoucher::route('/create'),
            'view' => Pages\ViewVoucher::route('/{record}'),
            'edit' => Pages\EditVoucher::route('/{record}/edit'),*/
        ];
    }
}
