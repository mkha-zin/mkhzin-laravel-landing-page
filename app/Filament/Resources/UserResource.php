<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
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
                Forms\Components\Section::make()->schema([
                    Forms\Components\TextInput::make('name')
                        ->label(__('dashboard.name'))
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('email')
                        ->label(__('dashboard.email'))
                        ->email()
                        ->required()
                        ->maxLength(255),
                    Forms\Components\Select::make('role')
                        ->label(__('dashboard.role'))
                        ->options([
                            'super' => __('dashboard.super admin'),
                            'admin' => __('dashboard.admin'),
                            'employee' => __('dashboard.employee'),
                        ])
                        ->required(),
                    Forms\Components\DateTimePicker::make('email_verified_at')
                        ->label(__('dashboard.email verified at')),
                    Forms\Components\TextInput::make('password')
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
                Tables\Columns\TextColumn::make('name')
                    ->label(__('dashboard.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('dashboard.email'))
                    ->searchable(),
                Tables\Columns\SelectColumn::make('role')
                    ->label(__('dashboard.role'))
                    ->options([
                        'super' => __('dashboard.super admin'),
                        'admin' => __('dashboard.admin'),
                        'employee' => __('dashboard.employee'),
                    ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('dashboard.created at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('dashboard.updated at'))
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
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
        ];
    }
}
