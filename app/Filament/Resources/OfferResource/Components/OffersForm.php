<?php

namespace App\Filament\Resources\OfferResource\Components;

use App\Models\Offer;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\App;

class OffersForm
{
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Select::make('branch_id')
                        ->label(__('dashboard.branch'))
                        ->relationship('branch',
                            App::currentLocale() === 'ar' ? 'name_ar' : 'name_en'
                        )
                        ->columnSpanFull()
                        ->required(),
                ])->columns(2),

                Section::make(__('dashboard.files'))->schema([
                    FileUpload::make('image')
                        ->label(__('dashboard.image'))
                        ->directory('assets/images/offers')
                        ->imageEditor()
                        ->image()
                        ->downloadable()
                        ->required(),
                    FileUpload::make('pdf_file')
                        ->helperText(__('dashboard.Only Compressed files are allowed'))
                        ->label(__('dashboard.file'))
                        ->getUploadedFileNameForStorageUsing(function (UploadedFile $file, ?Offer $record) {
                            if ($record) {
                                return 'offer-' . $record->id . '-' . $record->name_en . '-' . $file->getClientOriginalName();
                            }
                            return $file->getClientOriginalName();
                        })
                        ->directory('zips')
                        ->disk('zip')
                        ->acceptedFileTypes(['zip', 'application/octet-stream', 'application/zip', 'application/x-zip', 'application/x-zip-compressed'])
                        ->maxSize(50072)
                        ->downloadable()
                        ->required()
                ])->columns(2),
                Section::make(__(''))->schema([
                    TextInput::make('name_ar')
                        ->label(__('dashboard.name_ar'))
                        ->required()
                        ->maxLength(255),
                    TextInput::make('name_en')
                        ->label(__('dashboard.name_en'))
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

                Section::make(
                    __('dashboard.duration')
                )->schema([
                    DateTimePicker::make('start_date')
                        ->label(__('dashboard.start_date'))
                        ->required(),
                    DateTimePicker::make('end_date')
                        ->label(__('dashboard.end_date'))
                        ->required(),
                ])->columns(2),

                Toggle::make('is_active')
                    ->label(__('dashboard.status')),

            ]);
    }
}
