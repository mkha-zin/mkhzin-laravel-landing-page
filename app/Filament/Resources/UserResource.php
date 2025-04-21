<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
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
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('name')
                        ->label(__('dashboard.name'))
                        ->required()
                        ->maxLength(255),
                    TextInput::make('email')
                        ->label(__('dashboard.email'))
                        ->email()
                        ->required()
                        ->maxLength(255),
                    Select::make('role')
                        ->label(__('dashboard.role'))
                        ->options([
                            'super' => __('dashboard.super admin'),
                            'admin' => __('dashboard.admin'),
                            'employee' => __('dashboard.employee'),
                        ])
                        ->required(),
                    DateTimePicker::make('email_verified_at')
                        ->label(__('dashboard.email verified at')),
                    TextInput::make('password')
                        ->label(__('dashboard.password'))
                        ->password()
                        ->required()
                        ->maxLength(255),
                ])->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(User::where('id', '!=', auth()->id()))
            ->columns([
                TextColumn::make('name')
                    ->label(__('dashboard.name'))
                    ->searchable(),
                TextColumn::make('email')
                    ->label(__('dashboard.email'))
                    ->searchable(),
                SelectColumn::make('role')
                    ->label(__('dashboard.role'))
                    ->options([
                        'super' => __('dashboard.super admin'),
                        'admin' => __('dashboard.admin'),
                        'employee' => __('dashboard.employee'),
                    ])
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label(__('dashboard.created at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('dashboard.updated at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
        ];
    }
}
