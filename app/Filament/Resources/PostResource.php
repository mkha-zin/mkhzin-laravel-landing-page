<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\App;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;
    protected static ?int $navigationSort = 5;

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
        return __('dashboard.Posts');
    }

    public static function getPluralLabel(): ?string
    {
        return __('dashboard.Posts');
    }

    public static function getModelLabel(): string
    {
        return __('dashboard.Post');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    FileUpload::make('image')
                        ->label(__('dashboard.Image'))
                        ->directory('assets/images/posts')
                        ->imageEditor()
                        ->image()
                        ->required(),
                ])->columns(1),
                Section::make(__('dashboard.titles'))->schema([
                    TextInput::make('title_ar')
                        ->label(__('dashboard.title_ar'))
                        ->required()
                        ->maxLength(255),
                    TextInput::make('title_en')
                        ->label(__('dashboard.title_en'))
                        ->required()
                        ->maxLength(255),
                ])->columns(2),
                Section::make(__('dashboard.tagsandstatus'))->schema([
                    Select::make('tag_id')
                        ->relationship(
                            'tag',
                            App::currentLocale() === 'ar' ? 'tag_ar' : 'tag_en'
                        )
                        ->label(__('dashboard.tag'))
                        ->required(),
                    Select::make('status')
                        ->label(__('dashboard.status'))
                        ->options([
                            'active' => __('dashboard.active'),
                            'inactive' => __('dashboard.inactive'),
                        ]),
                    DatePicker::make('created_at')
                        ->label(__('dashboard.created at'))
                        ->required(),
                ])->columns(3),
                Section::make(__('dashboard.article'))->schema([
                    MarkdownEditor::make('article_ar')
                        ->label(__('dashboard.article_ar'))
                        ->required(),
                    MarkdownEditor::make('article_en')
                        ->label(__('dashboard.article_en'))
                        ->required(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->filters([
                    SelectFilter::make('tag')
                        ->relationship('tag', App::currentLocale() === 'ar' ? 'tag_ar' : 'tag_en')
                        ->label(__('dashboard.city'))
                    ->columnSpan(2)
                ]
                , layout: FiltersLayout::AboveContent)
            ->columns([
                TextColumn::make(
                    App::currentLocale() === 'ar' ? 'tag.tag_ar' : 'tag.tag_en'
                )
                    ->label(__('dashboard.tag'))
                    ->words(2)
                    ->sortable()
                    ->badge()
                    ->searchable(),
                TextColumn::make(
                    App::currentLocale() === 'ar' ? 'title_ar' : 'title_en'
                )
                    ->label(__('dashboard.title'))
                    ->limit(10)
                    ->searchable(),
                TextColumn::make(
                    App::currentLocale() === 'ar' ? 'article_ar' : 'article_en'
                )
                    ->label(__('dashboard.article'))
                    ->limit(15)
                    ->searchable(),
                ImageColumn::make('image')
                    ->alignCenter(),
                IconColumn::make('status')
                    ->sortable()
                    ->alignCenter()
                    ->label(__('dashboard.status'))
                    ->color(fn(Post $post) => $post->status === 'active' ? 'success' : 'danger')
                    ->icon(fn(Post $post) => $post->status === 'active' ? 'heroicon-s-check-circle' : 'heroicon-s-x-circle'),
                TextColumn::make('created_at')
                    ->label(__('dashboard.created at'))
                    ->date()
                    ->dateTimeTooltip('Y/m/d h:i:s A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('dashboard.updated at'))
                    ->date()
                    ->dateTimeTooltip('Y/m/d h:i:s A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->extremePaginationLinks()
            ->actions([
                ViewAction::make()
                    ->icon('heroicon-o-photo')
                    ->tooltip(__('dashboard.view'))
                    ->iconButton(),
                EditAction::make()
                    ->tooltip(__('dashboard.edit'))
                    ->color(Color::Blue)
                    ->iconButton(),
                Action::make('activate')
                    ->label(
                        fn(Post $post) => $post->status === 'active' ? __('dashboard.deactivate') : __('dashboard.activate')
                    )
                    ->tooltip(
                        fn(Post $post) => $post->status === 'active' ? __('dashboard.deactivate') : __('dashboard.activate')
                    )
                    ->color(
                        fn(Post $post) => $post->status === 'active' ? 'danger' : 'success'
                    )
                    ->icon(
                        fn(Post $post) => $post->status === 'active' ? 'heroicon-s-x-circle' : 'heroicon-s-check-circle'
                    )
                    ->action(function (Post $post) {
                        $post->update([
                            'status' => $post->status === 'active' ? 'inactive' : 'active',
                        ]);
                    })
                    ->iconButton()
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
        ];
    }
}
