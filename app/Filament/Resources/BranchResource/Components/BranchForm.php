<?php

namespace App\Filament\Resources\BranchResource\Components;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Illuminate\Support\Facades\App;

class BranchForm
{
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Select::make('city_id')
                        ->relationship('city',
                            App::currentLocale() === 'ar' ? 'name_ar' : 'name_en')
                        ->default(null),
                    Select::make('type')
                        ->label(__('dashboard.type'))
                        ->options([
                            'super' => __('dashboard.super'),
                            'hyper' => __('dashboard.hyper'),
                            'wholesale' => __('dashboard.wholesale'),
                        ]),
                ])->columns(2),
                Section::make([
                    TextInput::make('name_ar')
                        ->label(__('dashboard.name_ar'))
                        ->required()
                        ->maxLength(255),
                    TextInput::make('name_en')
                        ->label(__('dashboard.name_en'))
                        ->required()
                        ->maxLength(255),
                    MarkdownEditor::make('description_ar')
                        ->label(__('dashboard.description_ar'))
                        ->required(),
                    MarkdownEditor::make('description_en')
                        ->label(__('dashboard.description_en'))
                        ->required(),
                ])->columns(2),
                Section::make(__('dashboard.addresses'))->schema([
                    TextInput::make('address_ar')
                        ->label(__('dashboard.address_ar'))
                        ->required()
                        ->maxLength(255),
                    TextInput::make('address_en')
                        ->label(__('dashboard.address_en'))
                        ->required()
                        ->maxLength(255),
                    TextInput::make('longitude')
                        ->label(__('dashboard.longitude'))
                        ->required(),
                    TextInput::make('latitude')
                        ->label(__('dashboard.latitude'))
                        ->required(),
                    TextInput::make('map_link')
                        ->label(__('dashboard.map_link'))
                        ->hint(__('dashboard.map_link_helper'))
                        ->hintIcon('heroicon-o-information-circle')
                        ->url()
                        ->prefixIcon('heroicon-s-link')
                        ->columnSpanFull()
                        ->required(),
                ])->columns(2),
                Section::make(__('dashboard.social_link'))->schema([
                    TextInput::make('snapchat')
                        ->label(__('dashboard.snapchat'))
                        ->suffixIcon('heroicon-s-link')
                        ->url()
                        ->required(),
                    TextInput::make('instagram')
                        ->label(__('dashboard.instagram'))
                        ->suffixIcon('heroicon-s-link')
                        ->url()
                        ->required(),
                    TextInput::make('tiktok')
                        ->label(__('dashboard.tiktok'))
                        ->suffixIcon('heroicon-s-link')
                        ->url()
                        ->required(),
                ])->columns(3),
                Section::make(__('dashboard.files'))->schema([
                    FileUpload::make('image')
                        ->label(__('dashboard.image'))
                        ->directory('assets/images/branches')
                        ->imageEditor()
                        ->image()
                        ->required(),
                ]),
            ]);
    }

}
