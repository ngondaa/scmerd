<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubmissionResource\Pages\CreateSubmission;
use App\Filament\Resources\SubmissionResource\Pages\EditSubmission;
use App\Filament\Resources\SubmissionResource\Pages\ListSubmissions;
use App\Filament\Resources\SubmissionResource\RelationManagers\ReviewersRelationManager;
use App\Filament\Resources\SubmissionResource\RelationManagers\ReviewsRelationManager;
use App\Models\Submission;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SubmissionResource extends Resource
{
    protected static ?string $model = Submission::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected static string|\UnitEnum|null $navigationGroup = 'Conference';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'title';

    /**
     * @return array<string, string>
     */
    public static function statusOptions(): array
    {
        return [
            'Under Initial Review' => 'Under Initial Review',
            'Rebuttal Open' => 'Rebuttal Open',
            'Rebuttal Submitted' => 'Rebuttal Submitted',
            'Accepted' => 'Accepted',
            'Rejected' => 'Rejected',
        ];
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Submission details')
                    ->schema([
                        Select::make('user_id')
                            ->label('Author account')
                            ->relationship('user', 'email')
                            ->searchable()
                            ->preload()
                            ->required(),
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('author')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('track')
                            ->required()
                            ->maxLength(100)
                            ->datalist(['Abstract Submission']),
                        Select::make('status')
                            ->options(static::statusOptions())
                            ->required()
                            ->default('Under Initial Review'),
                        TextInput::make('stage')
                            ->maxLength(100),
                        TextInput::make('keywords')
                            ->maxLength(255),
                        DateTimePicker::make('submitted_at')
                            ->label('Submitted at')
                            ->default(now()),
                        FileUpload::make('attachment_path')
                            ->label('Attachment')
                            ->disk('public')
                            ->directory('submission_attachments')
                            ->storeFileNamesIn('attachment_name')
                            ->openable()
                            ->downloadable()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Abstract content')
                    ->schema([
                        Textarea::make('abstract')
                            ->required()
                            ->rows(12)
                            ->columnSpanFull(),
                        Textarea::make('rebuttal')
                            ->rows(6)
                            ->label('Rebuttal')
                            ->columnSpanFull(),
                        Textarea::make('comments')
                            ->label('Comments (JSON)')
                            ->rows(4)
                            ->helperText('Optional JSON array of comment entries.')
                            ->formatStateUsing(function ($state): ?string {
                                if ($state === null || $state === '') {
                                    return null;
                                }

                                return is_string($state)
                                    ? $state
                                    : json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
                            })
                            ->dehydrateStateUsing(function (?string $state) {
                                if (! filled($state)) {
                                    return null;
                                }

                                $decoded = json_decode($state, true);

                                return json_last_error() === JSON_ERROR_NONE ? $decoded : [$state];
                            })
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(40),
                TextColumn::make('author')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('track')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.email')
                    ->label('Submitted by')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Accepted' => 'success',
                        'Rejected' => 'danger',
                        'Rebuttal Open', 'Rebuttal Submitted' => 'warning',
                        default => 'gray',
                    }),
                TextColumn::make('reviewers_count')
                    ->counts('reviewers')
                    ->label('Reviewers')
                    ->sortable(),
                TextColumn::make('submitted_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('submitted_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options(static::statusOptions()),
                SelectFilter::make('track')
                    ->options(
                        Submission::query()
                            ->whereNotNull('track')
                            ->distinct()
                            ->orderBy('track')
                            ->pluck('track', 'track')
                            ->all()
                    ),
            ])
            ->recordActions([
                Action::make('accept')
                    ->label('Accept')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (Submission $record): bool => $record->status !== 'Accepted')
                    ->action(function (Submission $record): void {
                        $record->update(['status' => 'Accepted']);

                        Notification::make()
                            ->title('Submission accepted')
                            ->success()
                            ->send();
                    }),
                Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn (Submission $record): bool => $record->status !== 'Rejected')
                    ->action(function (Submission $record): void {
                        $record->update(['status' => 'Rejected']);

                        Notification::make()
                            ->title('Submission rejected')
                            ->danger()
                            ->send();
                    }),
                Action::make('openRebuttal')
                    ->label('Open rebuttal')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('warning')
                    ->visible(fn (Submission $record): bool => $record->status !== 'Rebuttal Open')
                    ->action(function (Submission $record): void {
                        $record->update(['status' => 'Rebuttal Open']);

                        Notification::make()
                            ->title('Rebuttal opened')
                            ->success()
                            ->send();
                    }),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ReviewersRelationManager::class,
            ReviewsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSubmissions::route('/'),
            'create' => CreateSubmission::route('/create'),
            'edit' => EditSubmission::route('/{record}/edit'),
        ];
    }
}
