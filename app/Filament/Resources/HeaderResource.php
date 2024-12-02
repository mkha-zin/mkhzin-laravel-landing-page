<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeaderResource\Pages;
use App\Filament\Resources\HeaderResource\RelationManagers;
use App\Models\Header;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class HeaderResource extends Resource
{
    protected static ?string $model = Header::class;

    public static function getNavigationGroup(): ?string
    {
        return __('dashboard.pageManagement');
    }

    protected static ?int $navigationSort = 2;

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.Headers');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.Headers');
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
                Forms\Components\Section::make()->schema([
                    Forms\Components\TextInput::make('key')
                        ->hidden()
                        ->required()
                        ->disabled()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('title_ar')
                        ->label(__('dashboard.title_ar'))
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('title_en')
                        ->label(__('dashboard.title_en'))
                        ->required()
                        ->maxLength(255),
                    Forms\Components\FileUpload::make('image')
                        ->label(__('dashboard.image'))
                        ->directory('assets/images/headers')
                        ->image()
                        ->imageEditor()
                        ->columnSpanFull()
                        ->required(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make(
                    App::currentLocale() == 'ar' ? 'title_ar' : 'title_en'
                )->label(__('dashboard.title'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label(__('dashboard.image')),
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
            'index' => Pages\ListHeaders::route('/'),
            /*'create' => Pages\CreateHeader::route('/create'),
            'view' => Pages\ViewHeader::route('/{record}'),
            'edit' => Pages\EditHeader::route('/{record}/edit'),*/
        ];
    }
}
