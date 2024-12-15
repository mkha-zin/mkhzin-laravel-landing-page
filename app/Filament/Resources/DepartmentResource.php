<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepartmentResource\Pages;
use App\Filament\Resources\DepartmentResource\RelationManagers;
use App\Models\Department;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title_ar')
                    ->label(__('dashboard.title_ar'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('title_en')
                    ->label(__('dashboard.title_en'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\MarkdownEditor::make('description_ar')
                    ->label(__('dashboard.description_ar'))
                    ->required(),
                Forms\Components\MarkdownEditor::make('description_en')
                    ->label(__('dashboard.description_en'))
                    ->required(),
                Forms\Components\TagsInput::make('tags_ar')
                    ->label(__('dashboard.tags')),
                Forms\Components\TagsInput::make('tags_en')
                    ->label(__('dashboard.tags')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make(
                    App::currentLocale() == 'ar' ? 'title_ar' : 'title_en'
                )
                    ->label(__('dashboard.title'))
                    ->words(5)
                    ->searchable(),
                Tables\Columns\TextColumn::make(
                    App::currentLocale() == 'ar' ? 'description_ar' : 'description_en'
                )
                    ->label(__('dashboard.description'))
                    ->words(5)
                    ->searchable(),
                Tables\Columns\TagsColumn::make(
                    App::currentLocale() == 'ar' ? 'tags_ar' : 'tags_en'
                )
                    ->label(__('dashboard.tags'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
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
            'index' => Pages\ListDepartments::route('/'),
        ];
    }
}
