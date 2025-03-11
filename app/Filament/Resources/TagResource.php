<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TagResource\Pages;
use App\Filament\Resources\TagResource\RelationManagers;
use App\Models\Tag;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Table;

class TagResource extends Resource
{
    protected static ?string $model = Tag::class;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.Blog');
    }

    /**
     * @return string
     */
    public static function getNavigationLabel(): string
    {
        return __('dashboard.tags');
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.tags');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.tag');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('tag_ar')
                    ->label(__('dashboard.tag_ar'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('tag_en')
                    ->label(__('dashboard.tag_en'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('status')
                    ->label(__('dashboard.status'))
                    ->options([
                        'active' => __('dashboard.active'),
                        'inactive' => __('dashboard.inactive'),
                    ]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tag_ar')
                    ->label(__('dashboard.tag_ar'))
                    ->sortable()
                    ->alignCenter()
                    ->searchable(),
                Tables\Columns\TextColumn::make('tag_en')
                    ->label(__('dashboard.tag_en'))
                    ->sortable()
                    ->alignCenter()
                    ->searchable(),
                Tables\Columns\IconColumn::make('status')
                    ->sortable()
                    ->alignCenter()
                    ->label(__('dashboard.status'))
                    ->color(fn(Tag $tag) => $tag->status === 'active' ? 'success' : 'danger')
                    ->icon(fn(Tag $tag) => $tag->status === 'active' ? 'heroicon-s-check-circle' : 'heroicon-s-x-circle'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('dashboard.created at'))
                    ->date()
                    ->dateTimeTooltip('Y/m/d h:i:s A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('dashboard.updated at'))
                    ->date()
                    ->dateTimeTooltip('Y/m/d h:i:s A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make()->color(Color::Blue),
                DeleteAction::make(),
                Action::make('activate')
                    ->label(
                        fn(Tag $record): string => $record->status === 'active' ? __('dashboard.deactivate') : __('dashboard.activate')
                    )
                    ->icon(fn(Tag $record): string => $record->status === 'active' ? 'heroicon-s-x-circle' : 'heroicon-s-check-circle')
                    ->color(fn(Tag $record): string => $record->status === 'active' ? 'danger' : 'success')
                    ->action(function (Tag $record) {
                        $record->update(['status' => $record->status === 'active' ? 'inactive' : 'active']);
                    })
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTags::route('/'),
        ];
    }
}
