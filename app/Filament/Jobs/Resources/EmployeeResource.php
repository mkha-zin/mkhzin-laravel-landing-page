<?php

namespace App\Filament\Jobs\Resources;

use App\Filament\Jobs\Resources\EmployeeResource\Pages;
use App\Filament\Jobs\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function getModelLabel(): string
    {
        return __('dashboard.Employee');
    }

    public static function getPluralModelLabel(): string
    {
        return __('dashboard.employees');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('dashboard.personal_info'))
                    ->collapsible()
                    ->schema([
                        Split::make([
                            FileUpload::make('image')
                                ->label(__('dashboard.image'))
                                ->directory('assets/images/employees')
                                ->imageEditor()
                                ->required()
                                ->columnSpanFull()
                                ->imageCropAspectRatio('1:1')
                                ->image(),
                            Section::make([
                                TextInput::make('name_ar')
                                    ->label(__('dashboard.name_ar'))
                                    ->required()
                                    ->columnSpanFull()
                                    ->maxLength(191),
                                TextInput::make('name_en')
                                    ->label(__('dashboard.name_en'))
                                    ->required()
                                    ->columnSpanFull()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (Set $set, $state) {
                                        $set('slug', Str::slug($state));
                                    }),
                                Select::make('branch_id')
                                    ->label(__('dashboard.branch'))
                                    ->relationship('branch', App::currentLocale() === 'ar' ? 'name_ar' : 'name_en')
                                    ->required(),
                                TextInput::make('slug')
                                    ->label(__('dashboard.slug'))
                                    ->required()
                                    ->disabled()
                                    ->maxLength(255),
                            ])->columns(2)
                        ])
                    ])
                    ->columnSpanFull(),
                Section::make(__('dashboard.career_info'))
                    ->collapsible()
                    ->schema([
                        TextInput::make('designation_ar')
                            ->label(__('dashboard.designation_ar'))
                            ->required()
                            ->maxLength(191)
                            ->default(null),
                        TextInput::make('designation_en')
                            ->label(__('dashboard.designation_en'))
                            ->required()
                            ->maxLength(191)
                            ->default(null),
                        Select::make('status')
                            ->label(__('dashboard.status'))
                            ->options([
                                'active' => __('dashboard.active'),
                                'inactive' => __('dashboard.inactive'),
                            ])
                            ->required(),
                    ])->columns(3),
                Repeater::make('contacts')
                    ->label(__('dashboard.contacts'))
                    ->collapsible()
                    ->schema([
                        Select::make('type')
                            ->label(__('dashboard.type'))
                            ->options([
                                'phone' => __('dashboard.phone'),
                                'email' => __('dashboard.email'),
                                'whatsapp' => __('dashboard.whatsapp'),
                            ])->required(),
                        TextInput::make('label')
                            ->label(__('dashboard.label'))
                            ->required(),
                        TextInput::make('value')
                            ->label(__('dashboard.value'))
                            ->required(),
                    ])->columns(2)
                    ->columnSpanFull()
                    ->default([]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make(
                    App::currentLocale() === 'ar' ? 'branch.name_ar' : 'branch.name_en'
                )
                    ->label(__('dashboard.branch'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make(
                    App::currentLocale() === 'ar' ? 'name_ar' : 'name_en'
                )
                    ->label(__('dashboard.name'))
                    ->searchable(),
                TextColumn::make(
                    App::currentLocale() === 'ar' ? 'designation_ar' : 'designation_en'
                )
                    ->label(__('dashboard.designation'))
                    ->searchable()
                    ->alignCenter(),
                ImageColumn::make('image')
                    ->label(__('dashboard.image'))
                    ->alignCenter(),
                IconColumn::make('status')
                    ->label(__('dashboard.status'))
                    ->alignCenter()
                    ->icon(
                        fn($state) => $state === 'active' ? 'heroicon-s-check-circle' : 'heroicon-s-x-circle'
                    )
                    ->color(
                        fn($state) => $state === 'active' ? 'success' : 'danger'
                    )
                    ->sortable()
                    ->action(
                        fn($record) => $record->status === 'active' ? $record->update(['status' => 'inactive']) : $record->update(['status' => 'active'])
                    )
                    ->tooltip(
                        fn($state) => $state === 'active' ? __('dashboard.active') : __('dashboard.inactive')
                    ),
                TextColumn::make('created_at')
                    ->label(__('dashboard.created at'))
                    ->date()
                    ->dateTimeTooltip('Y/m/d h:i:s A')
                    ->alignCenter()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('dashboard.updated at'))
                    ->date()
                    ->dateTimeTooltip('Y/m/d h:i:s A')
                    ->alignCenter()
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'view' => Pages\ViewEmployee::route('/{record}'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
