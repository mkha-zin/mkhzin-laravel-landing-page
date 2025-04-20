<?php

namespace App\Filament\Jobs\Resources;

use App\Filament\Jobs\Resources\CareerResource\Pages;
use App\Filament\Jobs\Resources\CareerResource\RelationManagers;
use App\Models\Application;
use App\Models\Career;
use Filament\Forms;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section as InfoSection;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CareerResource extends Resource
{
    protected static ?string $model = Career::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function getModelLabel(): string
    {
        return __('dashboard.career');
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.Careers');
    }

    public static function getLabel(): ?string
    {
        return __('dashboard.Career');
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
                Section::make([
                    TextInput::make('title')
                        ->label(__('dashboard.title'))
                        ->required(),
                    Select::make('type')
                        ->label(__('dashboard.job type'))
                        ->options([
                            'remote' => __('dashboard.Remote'),
                            'on-site' => __('dashboard.On-site'),
                        ])
                        ->required(),
                    Toggle::make('is_active')
                        ->label(__('dashboard.status'))
                        ->default(true),
                    MarkdownEditor::make('description')
                        ->label(__('dashboard.description'))
                        ->columnSpanFull()
                        ->required(),
                ])->columns(3),
                Section::make([
                    Repeater::make('questions')
                        ->collapsible()
                        ->schema([
                            TextInput::make('question')
                                ->label(__('dashboard.Question'))
                                ->required(),

                            Select::make('type')
                                ->label(__('dashboard.answer type'))
                                ->options([
                                    'yes_no' => __('dashboard.Yes / No Answer'),
                                    'text' => __('dashboard.Text Answer'),
                                    'number' => __('dashboard.Numeric Answer'),
                                    'choices' => __('dashboard.Multiple Choices'),
                                ])
                                ->reactive()
                                ->required(),

                            Textarea::make('options')
                                ->label(__('dashboard.Write Multiple Choices'))
                                ->visible(fn($get) => $get('type') === 'choices')
                                ->helperText(__('dashboard.answer example')),
                        ])
                        ->label(__('dashboard.additional questions'))
                        ->addActionLabel(__('dashboard.add a question'))
                        ->default([])
                        ->columnSpanFull(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        foreach (Career::all() as $career) {
            $career->applicants = Application::query()->where('job_id', $career->id)->count();
            $career->save();
        }

        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('dashboard.title'))
                    ->searchable(),
                TextColumn::make('description')
                    ->label(__('dashboard.description'))
                    ->markdown()
                    ->words(5)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('type')
                    ->label(__('dashboard.job type'))
                    ->tooltip(
                        fn($record) => $record->type === 'remote' ? __('dashboard.Remote') : __('dashboard.On-site')
                    )
                    ->sortable(),
                TextColumn::make('applicants')
                    ->label(__('dashboard.applicants'))
                    ->numeric(locale: 'en')
                    ->sortable(),
                ViewColumn::make('questions')
                    ->label(__('dashboard.additional questions'))
                    ->view('jobs.question_view'),
                IconColumn::make('is_active')
                    ->label(__('dashboard.status'))
                    ->tooltip(fn($record) => $record->is_active ? __('dashboard.active') : __('dashboard.inactive'))
                    ->color(fn($record) => $record->is_active ? 'success' : 'danger')
                    ->icon(fn($record) => $record->is_active ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle')
                    ->boolean(),
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
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make()
                    ->label('')
                    ->iconButton()
                    ->tooltip(__('dashboard.view job'))
                    ->icon('heroicon-o-briefcase'),
                EditAction::make()
                    ->label('')
                    ->iconButton()
                    ->tooltip(__('dashboard.edit job'))
                    ->color(Color::hex('#6366f1')),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfoSection::make(__('dashboard.Career'))
                    ->schema([
                        TextEntry::make('title')
                            ->label(__('dashboard.title')),
                        TextEntry::make('type')
                            ->label(__('dashboard.job type'))
                            ->badge()
                            ->color(fn(string $state) => $state === 'remote' ? 'info' : 'primary')
                            ->formatStateUsing(fn(string $state) => $state === 'remote' ? __('dashboard.Remote') : __('dashboard.On-site')),
                        IconEntry::make('is_active')
                            ->label(__('dashboard.status'))
                            ->boolean()
                            ->trueIcon('heroicon-o-check-circle')
                            ->falseIcon('heroicon-o-x-circle')
                            ->trueColor('success')
                            ->falseColor('danger'),
                        TextEntry::make('description')
                            ->label(__('dashboard.description'))
                            ->markdown()
                            ->columnSpanFull(),
                    ])
                    ->columns(3),
                InfoSection::make(__('dashboard.additional questions'))
                    ->schema([
                        RepeatableEntry::make('questions')
                            ->label(false)
                            ->schema([
                                TextEntry::make('question')
                                    ->label(__('dashboard.Question')),
                                TextEntry::make('type')
                                    ->label(__('dashboard.answer type'))
                                    ->formatStateUsing(function ($state) {
                                        return match ($state) {
                                            'yes_no' => __('dashboard.Yes / No Answer'),
                                            'text' => __('dashboard.Text Answer'),
                                            'number' => __('dashboard.Numeric Answer'),
                                            'choices' => __('dashboard.Multiple Choices'),
                                            default => $state,
                                        };
                                    }),
                                TextEntry::make('options')
                                    ->label(__('dashboard.Multiple Choices'))
                                    ->formatStateUsing(function ($state, $record) {
                                        // Iterate through questions and find the matching type
                                        foreach ($record->questions as $question) {
                                            if ($question['type'] === 'choices') {
                                                if (!empty($question['options'])) {
                                                    // Convert the comma-separated string into a readable list
                                                    $options = explode(',', $question['options']);
                                                    return collect($options)->map(fn($item) => '• ' . trim($item))->implode("\n");
                                                }
                                            }
                                        }
                                        return null;
                                    })
                            ])
                            ->columns(3)
                            ->columnSpanFull(),
                    ])
                    ->collapsed()
                    ->collapsible(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
          RelationManagers\ApplicationsRelationManager::class,
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCareers::route('/'),
            'create' => Pages\CreateCareer::route('/create'),
            'view' => Pages\ViewCareer::route('/{record}'),
            'edit' => Pages\EditCareer::route('/{record}/edit'),
        ];
    }
}
