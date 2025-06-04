<?php

namespace App\Filament\Resources\DepartmentResource\Components;

use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

class DepartmentForm
{
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
}
