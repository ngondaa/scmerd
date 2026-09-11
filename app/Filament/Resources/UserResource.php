<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Filament\Resources\UserResource\Pages\ListUsers;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-group';

    protected static string|\UnitEnum|null $navigationGroup = 'Registration';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationBadge(): ?string
    {
        $count = User::query()->needsPaymentReview()->count();

        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'warning';
    }

    public static function form(Schema $schema): Schema
    {
        $packages = collect(config('registration.packages', []))
            ->mapWithKeys(fn (array $package, string $key) => [
                $key => ($package['name'] ?? ucfirst($key)).' ('.$package['display_price'].')',
            ])
            ->all();

        return $schema
            ->components([
                Section::make('Profile')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Toggle::make('is_reviewer')
                            ->label('Reviewer access')
                            ->helperText('Grant access to the reviewer dashboard.'),
                        Toggle::make('is_admin')
                            ->label('Admin access')
                            ->helperText('Grant access to the Filament admin panel.'),
                        Select::make('registration_package')
                            ->label('Registration package')
                            ->options($packages)
                            ->searchable()
                            ->nullable(),
                        TextInput::make('password')
                            ->password()
                            ->revealable()
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->dehydrated(fn (?string $state): bool => filled($state))
                            ->helperText('Leave blank when editing to keep the existing password.'),
                    ])
                    ->columns(2),

                Section::make('Registration details')
                    ->schema([
                        Toggle::make('ecsa_accredited')
                            ->label('ECSA accredited'),
                        TextInput::make('ecsa_number')
                            ->maxLength(100),
                        TextInput::make('student_id')
                            ->maxLength(100),
                        TextInput::make('certificate_name')
                            ->maxLength(255),
                        DateTimePicker::make('registration_paid_at')
                            ->label('Registration paid at'),
                        Select::make('registration_status')
                            ->options([
                                'unpaid' => 'Unpaid',
                                'pending' => 'Pending review',
                                'pending_review' => 'AI flagged for review',
                                'paid' => 'Paid',
                                'rejected' => 'Rejected',
                            ])
                            ->default('unpaid')
                            ->required(),
                        FileUpload::make('payment_proof_path')
                            ->label('Payment proof')
                            ->disk('public')
                            ->directory('payment_proofs')
                            ->acceptedFileTypes([
                                'application/pdf',
                                'application/msword',
                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                'image/jpeg',
                                'image/png',
                                'image/webp',
                            ])
                            ->openable()
                            ->downloadable()
                            ->columnSpanFull(),
                        Textarea::make('payment_proof_analysis')
                            ->label('Proof analysis')
                            ->rows(6)
                            ->disabled()
                            ->dehydrated(false)
                            ->formatStateUsing(function ($state): ?string {
                                if (! filled($state)) {
                                    return null;
                                }

                                if (is_string($state)) {
                                    $decoded = json_decode($state, true);

                                    return $decoded
                                        ? json_encode($decoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
                                        : $state;
                                }

                                return json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
                            })
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('registration_package')
                    ->label('Package')
                    ->sortable()
                    ->toggleable(),
                IconColumn::make('is_reviewer')
                    ->label('Reviewer')
                    ->boolean()
                    ->sortable(),
                IconColumn::make('is_admin')
                    ->label('Admin')
                    ->boolean()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('registration_status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'paid' => 'success',
                        'pending', 'pending_review' => 'warning',
                        'rejected' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending_review' => 'AI review',
                        default => ucfirst(str_replace('_', ' ', $state)),
                    })
                    ->sortable(),
                IconColumn::make('payment_proof_path')
                    ->label('Proof')
                    ->boolean()
                    ->getStateUsing(fn (User $record): bool => filled($record->payment_proof_path)),
                TextColumn::make('registration_paid_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Filter::make('needs_payment_review')
                    ->label('Pending payment proofs')
                    ->query(fn (Builder $query): Builder => $query->needsPaymentReview())
                    ->default(false),
                SelectFilter::make('registration_status')
                    ->options([
                        'unpaid' => 'Unpaid',
                        'pending' => 'Pending review',
                        'pending_review' => 'AI flagged for review',
                        'paid' => 'Paid',
                        'rejected' => 'Rejected',
                    ]),
                SelectFilter::make('registration_package')
                    ->options(
                        collect(config('registration.packages', []))
                            ->mapWithKeys(fn (array $package, string $key) => [$key => $package['name'] ?? ucfirst($key)])
                            ->all()
                    ),
                TernaryFilter::make('is_reviewer')
                    ->label('Reviewer status')
                    ->placeholder('All users')
                    ->trueLabel('Reviewers')
                    ->falseLabel('Non-reviewers'),
                TernaryFilter::make('is_admin')
                    ->label('Admin status')
                    ->placeholder('All users')
                    ->trueLabel('Admins')
                    ->falseLabel('Non-admins'),
            ])
            ->recordActions([
                Action::make('approvePayment')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Approve payment proof')
                    ->modalDescription('Mark this registration as paid and unlock abstract submission.')
                    ->visible(fn (User $record): bool => $record->needsPaymentReview() || $record->registration_status === 'rejected')
                    ->action(function (User $record): void {
                        $record->approvePayment();

                        Notification::make()
                            ->title('Payment approved')
                            ->success()
                            ->send();
                    }),
                Action::make('rejectPayment')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Reject payment proof')
                    ->modalDescription('Reject this proof of payment. The user will remain unpaid.')
                    ->visible(fn (User $record): bool => $record->needsPaymentReview() || $record->registration_status === 'paid')
                    ->action(function (User $record): void {
                        $record->rejectPayment();

                        Notification::make()
                            ->title('Payment rejected')
                            ->danger()
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

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
