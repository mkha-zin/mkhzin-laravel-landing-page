<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepartmentResource\Pages;
use App\Models\Department;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class DepartmentResource extends Resource
{
    protected static ?string $model = Department::class;

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.servicesManagement');
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.departments');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.department');
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function getRecordTitleAttribute(): ?string
    {
        return App::currentLocale() === 'ar' ? 'title_ar' : 'title_en';
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title_ar', 'title_en', 'description_ar', 'description_en', 'tags_ar', 'tags_en'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            __('dashboard.name') => App::currentLocale() === 'ar' ? $record->title_ar : $record->title_en,
            __('dashboard.description') => App::currentLocale() === 'ar' ? $record->description_ar : $record->description_en,
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title_ar')
                    ->label(__('dashboard.title_ar'))
                    ->required()
                    ->maxLength(255),
                TextInput::make('title_en')
                    ->label(__('dashboard.title_en'))
                    ->required()
                    ->maxLength(255),
                MarkdownEditor::make('description_ar')
                    ->label(__('dashboard.description_ar'))
                    ->required(),
                MarkdownEditor::make('description_en')
                    ->label(__('dashboard.description_en'))
                    ->required(),
                TagsInput::make('tags_ar')
                    ->label(__('dashboard.tags'))
                    ->reorderable(),
                TagsInput::make('tags_en')
                    ->label(__('dashboard.tags'))
                    ->reorderable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make(
                    App::currentLocale() === 'ar' ? 'title_ar' : 'title_en'
                )
                    ->label(__('dashboard.title'))
                    ->words(5)
                    ->searchable(),
                TextColumn::make(
                    App::currentLocale() === 'ar' ? 'description_ar' : 'description_en'
                )
                    ->label(__('dashboard.description'))
                    ->width(400)
                    ->words(50)
                    ->wrap()
                    ->searchable(),
                TagsColumn::make(
                    App::currentLocale() === 'ar' ? 'tags_ar' : 'tags_en'
                )
                    ->label(__('dashboard.tags'))
                    ->limitList(30)
                    ->searchable(),
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
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDepartments::route('/'),
        ];
    }
}
