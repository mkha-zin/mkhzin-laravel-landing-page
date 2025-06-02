<?php

namespace App\Filament\Resources\UserResource\Components;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

class UsersForm
{
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
}
