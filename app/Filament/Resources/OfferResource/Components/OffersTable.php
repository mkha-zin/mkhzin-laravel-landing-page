<?php

namespace App\Filament\Resources\OfferResource\Components;

use App\Mail\OffersEmail;
use App\Models\Offer;
use App\Models\Subscription;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ReplicateAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Webbingbrasil\FilamentAdvancedFilter\Filters\BooleanFilter;
use Webbingbrasil\FilamentAdvancedFilter\Filters\DateFilter;

class OffersTable
{
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make(
                    App::currentLocale() === 'ar' ? 'name_ar' : 'name_en'
                )
                    ->label(__('dashboard.name'))
                    ->searchable(),

                TextColumn::make(
                    App::currentLocale() === 'ar' ? 'description_ar' : 'description_en'
                )
                    ->label(__('dashboard.description'))
                    ->words(5)
                    ->searchable(),
                TextColumn::make(
                    App::currentLocale() === 'ar' ? 'branch.name_ar' : 'branch.name_en'
                )
                    ->label(__('dashboard.branch'))
                    ->searchable()
                    ->toggleable(),
                ImageColumn::make('image')
                    ->label(__('dashboard.Image')),
                TextColumn::make('pdf_file')
                    ->label(__('dashboard.files'))
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('start_date')
                    ->label(__('dashboard.start_date'))
                    ->date()
                    ->dateTimeTooltip('D Y/m/d h:i:s A')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make('end_date')
                    ->label(__('dashboard.end_date'))
                    ->date()
                    ->dateTimeTooltip('D Y/m/d h:i:s A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                CheckboxColumn::make('is_active')
                    ->label(__('dashboard.status')),
                TextColumn::make('created_at')
                    ->label(__('dashboard.created at'))
                    ->date()
                    ->dateTimeTooltip('D Y/m/d h:i:s A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('dashboard.updated at'))
                    ->date()
                    ->dateTimeTooltip('D Y/m/d h:i:s A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->extremePaginationLinks()
            ->defaultSort('created_at', 'desc')
            ->filters([
                BooleanFilter::make('is_active')
                    ->label(__('dashboard.status')),
                DateFilter::make('created_at')
                    ->label(__('dashboard.created at')),
            ])
            ->actions([
                ViewAction::make()->label('')->tooltip(__('dashboard.View Offer')),
                EditAction::make()->label('')->tooltip(__('dashboard.Edit Offer')),
                DeleteAction::make()->label('')->tooltip(__('dashboard.Delete Offer')),
                ReplicateAction::make()
                    ->label('')
                    ->tooltip(__('dashboard.Replicate Offer'))
                    ->excludeAttributes(['is_active'])
                    ->form([
                        Section::make()->schema([
                            Select::make('branch_id')
                                ->label(__('dashboard.branch'))
                                ->relationship('branch',
                                    App::currentLocale() === 'ar' ? 'name_ar' : 'name_en'
                                )
                                ->columnSpanFull()
                                ->required(),
                        ])->columns(2),

                        Section::make(__('dashboard.files'))
                            ->collapsible()
                            ->collapsed()
                            ->schema([
                                FileUpload::make('image')
                                    ->label(__('dashboard.Image'))
                                    ->directory('assets/images/offers')
                                    ->imageEditor()
                                    ->image()
                                    ->required(),
                                FileUpload::make('pdf_file')
                                    ->helperText(__('dashboard.Only Compressed files are allowed'))
                                    ->label(__('dashboard.file'))
                                    ->getUploadedFileNameForStorageUsing(function (UploadedFile $file, ?Offer $record) {
                                        if ($record) {
                                            return 'offer-' . $record->id . '-' . $record->name_en . '-' . $file->getClientOriginalName();
                                        }
                                        return 'offer-' . now() . $file->getClientOriginalName();
                                    })
                                    ->directory('zips')
                                    ->disk('zip')
                                    ->acceptedFileTypes(['zip', 'application/octet-stream', 'application/zip', 'application/x-zip', 'application/x-zip-compressed'])
                                    ->maxSize(50072)
                                    ->downloadable()
                                    ->required()
                            ])->columns(2),
                        Section::make(__('dashboard.title'))
                            ->collapsible()
                            ->collapsed()
                            ->schema([
                                TextInput::make('name_ar')
                                    ->label(__('dashboard.name_ar'))
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('name_en')
                                    ->label(__('dashboard.name_en'))
                                    ->required()
                                    ->maxLength(255),
                            ])->columns(2),
                        Section::make(__('dashboard.descriptions'))
                            ->collapsible()
                            ->collapsed()
                            ->schema([
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
                            DatePicker::make('start_date')
                                ->label(__('dashboard.start_date'))
                                ->required(),
                            DatePicker::make('end_date')
                                ->label(__('dashboard.end_date'))
                                ->required(),
                        ])->columns(2),

                        Toggle::make('is_active')
                            ->label(__('dashboard.status')),
                    ])
                    ->beforeReplicaSaved(function (Model $replica, array $data): void {
                        $replica->fill($data);
                    }),
                Action::make('send-offer')
                    ->label(__('dashboard.Send Offer'))
                    ->icon('heroicon-o-paper-airplane')
                    ->iconButton()
                    ->color('success')
                    ->form([
                        TextInput::make('email_subject')
                            ->label('Email Subject')
                            ->placeholder('Enter a subject for the email')
                            ->required()
                            ->default(fn(Offer $record) => $record->name_ar ?? 'Check out our latest offer!'),
                        TextInput::make('email_description')
                            ->label('Email Description')
                            ->placeholder('Enter a description for the email')
                            ->required()
                            ->default(fn(Offer $record) => $record->description_ar ?? 'We have a new offer for you!'),

                        Toggle::make('send_to_all')
                            ->label('Send to all subscribers')
                            ->default(true)
                            ->reactive(),

                        Select::make('selected_subscribers')
                            ->label('Select specific subscribers')
                            ->multiple()
                            ->maxItems(199)
                            ->searchable()
                            ->preload()
                            ->options(
                                fn() => Subscription::where('is_active', true)
                                    ->pluck('email', 'id')
                                    ->toArray()
                            )
                            ->hidden(fn(callable $get) => $get('send_to_all')),
                    ])
                    ->requiresConfirmation()
                    ->action(function (array $data, Offer $record) {
                        $emails = [];

                        if ($data['send_to_all']) {
                            $emails = Subscription::where('is_active', true)->pluck('email')->toArray();
                        } else {
                            $emails = Subscription::whereIn('id', $data['selected_subscribers'])->pluck('email')->toArray();
                        }

                        foreach ($emails as $email) {
                            $unsubscribeUrl = route('unsubscribe', ['email' => $email]);

                            Mail::to($email)->queue(new OffersEmail(
                                offerUrl: url('/view-pdf/' . $record->id),
                                offerImageUrl: asset('storage/' . $record->image),
                                unsubscribeUrl: $unsubscribeUrl,
                                emailSubject: $data['email_subject'],
                                offerDescription: $record->description_ar,
                            ));
                        }

                        Notification::make()
                            ->title('Offer email sent successfully.')
                            ->success()
                            ->send();
                    })
                    ->tooltip('Send this offer to all or selected subscribers'),


            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }
}
