<?php

namespace App\Filament\Jobs\Resources\JobsSettingResource\Pages;

use App\Filament\Jobs\Resources\JobsSettingResource;
use App\Filament\Resources\SettingResource;
use App\Models\JobsSetting;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class Settings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = JobsSettingResource::class;

    protected static string $view = 'filament.jobs.resources.jobs-setting-resource.pages.settings';

    public array $formData = [];

    public function mount(): void
    {
        $record = JobsSetting::first();

        if ($record) {
            $this->formData = $record->toArray();
        }
    }

    public function getTitle(): string|Htmlable
    {
        return __('dashboard.Settings');
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('formData')
            ->schema([
                Section::make(__('dashboard.Home'))
                    ->schema([
                        TextInput::make('home_title_ar')
                            ->label(__('dashboard.title_ar'))
                            ->required()
                            ->maxLength(191),
                        TextInput::make('home_title_en')
                            ->label(__('dashboard.title_en'))
                            ->required()
                            ->maxLength(191),
                        MarkdownEditor::make('home_description_ar')
                            ->label(__('dashboard.description_ar'))
                            ->required(),
                        MarkdownEditor::make('home_description_en')
                            ->label(__('dashboard.description_en'))
                            ->required(),
                    ])
                    ->collapsible()
                    ->description(__('dashboard.home_desc'))
                    ->columns(2),
                Section::make(__('dashboard.Hiring Applications'))
                    ->schema([
                        TextInput::make('general_title_ar')
                            ->label(__('dashboard.title_ar'))
                            ->required()
                            ->maxLength(191),
                        TextInput::make('general_title_en')
                            ->label(__('dashboard.title_en'))
                            ->required()
                            ->maxLength(191),
                        MarkdownEditor::make('general_description_ar')
                            ->label(__('dashboard.description_ar'))
                            ->required(),
                        MarkdownEditor::make('general_description_en')
                            ->label(__('dashboard.description_en'))
                            ->required(),
                    ])
                    ->collapsible()
                    ->description(__('dashboard.general_desc'))
                    ->columns(2),
            ]);
    }

    public function save(): void
    {
        $record = JobsSetting::first();

        if ($record) {
            $record->update($this->formData);
        } else {
            JobsSetting::create($this->formData);
        }

        Notification::make()
            ->success()
            ->title(__('dashboard.Settings updated successfully'))
            ->send();
    }
}
