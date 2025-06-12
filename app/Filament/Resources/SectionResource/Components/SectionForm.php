<?php

namespace App\Filament\Resources\SectionResource\Components;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

class SectionForm
{
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('dashboard.Image'))
                    ->schema([
                        FileUpload::make('image')
                            ->label(__('dashboard.Image'))
                            ->directory('assets/images/sections')
                            ->columnSpanFull()
                            ->imageEditor()
                            ->downloadable()
                            ->image()
                            ->required(),
                    ])->columns(2),
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
                Section::make(__('dashboard.descriptions'))->schema([
                    MarkdownEditor::make('description_ar')
                        ->label(__('dashboard.description_ar'))
                        ->required(),
                    MarkdownEditor::make('description_en')
                        ->label(__('dashboard.description_en'))
                        ->required(),
                ])->columns(2),
            ]);
    }
}
