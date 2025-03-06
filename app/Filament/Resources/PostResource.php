<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

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
        return __('dashboard.aboutCompanySettings');
    }

    /**
     * @return string
     */
    public static function getNavigationLabel(): string
    {
        return __('dashboard.Blog');
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
                Forms\Components\Section::make()->schema([
                    Forms\Components\FileUpload::make('image')
                        ->label(__('dashboard.image'))
                        ->directory('assets/images/posts')
                        ->imageEditor()
                        ->image()
                        ->required(),
                ])->columns(1),
                Forms\Components\Section::make(__('dashboard.titles'))->schema([
                    Forms\Components\TextInput::make('title_ar')
                        ->label(__('dashboard.title_ar'))
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('title_en')
                        ->label(__('dashboard.title_en'))
                        ->required()
                        ->maxLength(255),
                ])->columns(2),
                Forms\Components\Section::make(__('dashboard.tagsandstatus'))->schema([
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
                        ])
                ])->columns(3),
                Forms\Components\Section::make(__('dashboard.article'))->schema([
                    Forms\Components\MarkdownEditor::make('article_ar')
                        ->label(__('dashboard.article_ar'))
                        ->required(),
                    Forms\Components\MarkdownEditor::make('article_en')
                        ->label(__('dashboard.article_en'))
                        ->required(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make(
                    App::currentLocale() === 'ar' ? 'tag_ar' : 'tag_en'
                )
                    ->label(__('dashboard.tag'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make(
                    App::currentLocale() === 'ar' ? 'title_ar' : 'title_en'
                )
                    ->label(__('dashboard.title'))
                    ->searchable(),
                Tables\Columns\TextColumn::make(
                    App::currentLocale() === 'ar' ? 'article_ar' : 'article_en'
                )
                    ->label(__('dashboard.article'))
                    ->limit(10)
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\IconColumn::make('status')
                    ->sortable()
                    ->label(__('dashboard.status'))
                    ->color(fn(Post $post) => $post->status === 'active' ? 'success' : 'danger')
                    ->icon(fn(Post $post) => $post->status === 'active' ? 'heroicon-s-check-circle' : 'heroicon-s-x-circle'),
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
                Tables\Actions\ViewAction::make()
                    ->icon('heroicon-o-photo')
                    ->tooltip(__('dashboard.view'))
                    ->iconButton(),
                Tables\Actions\EditAction::make()
                    ->tooltip(__('dashboard.edit'))
                    ->iconButton(),
                Tables\Actions\Action::make('activate')
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
                    ->iconButton()
                    ->requiresConfirmation()
                    ->action(function (Post $post) {
                        $post->status = $post->status === 'active' ? 'inactive' : 'active';
                        $post->save();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
