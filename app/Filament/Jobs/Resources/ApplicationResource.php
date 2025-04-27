<?php

namespace App\Filament\Jobs\Resources;

use App\Filament\Jobs\Resources\ApplicationResource\Pages;
use App\Filament\Jobs\Resources\ApplicationResource\RelationManagers;
use App\Models\Application;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\IconPosition;
use Filament\Tables;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Table;

class ApplicationResource extends Resource
{
    protected static ?string $model = Application::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function getModelLabel(): string
    {
        return __('dashboard.application');
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.Applications');
    }

    public static function getLabel(): ?string
    {
        return __('dashboard.Application');
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.Jobs Settings');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('job_id')
                    ->relationship('job', 'title')
                    ->required(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(191),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(191),
                TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(191),
                TextInput::make('address')
                    ->required()
                    ->maxLength(191),
                Textarea::make('resume_link')
                    ->columnSpanFull(),
                Textarea::make('answers')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('job.title')
                    ->label(__('dashboard.Career'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('name')
                    ->label(__('dashboard.name'))
                    ->searchable(),
                TextColumn::make('phone')
                    ->label(__('dashboard.contact info'))
                    ->description(fn(Application $record): string => $record->email)
                    ->icon('heroicon-m-device-phone-mobile')
                    ->iconPosition(IconPosition::Before)
                    ->url(fn(Application $record): string => 'tel:' . $record->phone)
                    ->searchable(),
                TextColumn::make('address')
                    ->label(__('dashboard.address'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                ViewColumn::make('answers')
                    ->label(__('dashboard.QaA'))
                    ->view('jobs.answers_view'),
                IconColumn::make('resume_link')
                    ->icon('heroicon-o-arrow-down-circle')
                    ->alignCenter()
                    ->color('success')
                    ->label(__('dashboard.resume'))
                    ->url(function ($record) {
                        $data['resume_link'] = $record->resume_link;
                        $data['key'] = $record->id;
                        return route('resume.download', $data);
                    }),
                TextColumn::make('created_at')
                    ->label(__('dashboard.created_at'))
                    ->date()
                    ->dateTimeTooltip('D Y/M/d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('dashboard.updated_at'))
                    ->date()
                    ->dateTimeTooltip('D Y/M/d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                ViewAction::make()->icon('heroicon-o-clipboard-document-list'),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make(__('dashboard.Application Details'))
                    ->columns(2)
                    ->headerActions([
                        Action::make('download')
                            ->label(__('dashboard.download cv'))
                            ->icon('heroicon-o-arrow-down-circle')
                            ->action('download'),
                    ])
                    ->schema([
                        TextEntry::make('name')
                            ->label(__('dashboard.name'))
                            ->icon('heroicon-m-user')
                            ->weight('bold'),

                        TextEntry::make('email')
                            ->label(__('dashboard.email'))
                            ->url(fn(Application $record): string => 'mailto:' . $record->email)
                            ->icon('heroicon-m-envelope'),

                        TextEntry::make('phone')
                            ->label(__('dashboard.phone'))
                            ->url(fn(Application $record): string => 'tel:' . $record->phone)
                            ->icon('heroicon-m-phone'),

                        TextEntry::make('address')
                            ->label(__('dashboard.address'))
                            ->icon('heroicon-o-map-pin'),
                    ]),

                Section::make(__('dashboard.QaA'))
                    ->schema([
                        TextEntry::make('answers')
                            ->label('')
                            ->visible(fn($record) => is_array(json_decode($record->answers, true)) && count(json_decode($record->answers, true)))
                            ->columnSpanFull()
                            ->formatStateUsing(function ($state) {
                                $answers = json_decode($state, true);

                                if (!is_array($answers) || empty($answers)) {
                                    return __('No additional questions.');
                                }
                                $output = '';
                                foreach ($answers as $index => $item) {
                                    $output .= "<div class='my-2 text-sm border rounded p-2 pb-2'>";
                                    $output .= "<strong>" . __('dashboard.q') . ($index + 1) . ":</strong> " . ($item['question'] ?? '');
                                    $output .= "<div class='text-sm ps-3 mt-1'>";
                                    if (isset($item['type']) && $item['type'] == 'yes_no') {
                                        $output .= "<span class='font-semibold'>" . __('dashboard.a') . ":</span> " . (__('dashboard.' . $item['answer']) ?? __('No answer'));
                                    }
                                    $output .= "<span class='font-semibold'>" . __('dashboard.a') . ":</span> " . ($item['answer'] ?? __('No answer'));
                                    $output .= "</div></div>";
                                }
                                return $output;
                            })
                            ->html(),
                    ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListApplications::route('/'),
            'create' => Pages\CreateApplication::route('/create'),
            'view' => Pages\ViewApplication::route('/{record}'),
            'edit' => Pages\EditApplication::route('/{record}/edit'),
        ];
    }
}
