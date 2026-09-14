<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentProofResource\Pages\ListPaymentProofs;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class PaymentProofResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationLabel = 'Payment proofs';

    protected static ?string $modelLabel = 'Payment proof';

    public static function canViewAny(): bool
    {
        return (bool) (auth()->user()?->is_admin || auth()->user()?->is_payment_reviewer);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereNotNull('payment_proof_path');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Registrant')->searchable()->sortable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('payment_invoice_number')
                    ->label('Invoice reference')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('registration_package')->label('Package')->formatStateUsing(fn (?string $state): string => config('registration.packages.'.$state.'.name', ucfirst((string) $state))),
                TextColumn::make('registration_fee')
                    ->label('Fee')
                    ->getStateUsing(fn (User $record): ?string => config('registration.packages.'.$record->registration_package.'.display_price'))
                    ->toggleable(),
                TextColumn::make('certificate_name')->label('Certificate name')->toggleable(),
                TextColumn::make('ecsa_number')->label('ECSA number')->placeholder('—')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('student_id')->label('Student number')->placeholder('—')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('payment_proof_original_name')
                    ->label('Proof of payment')
                    ->default('View uploaded proof')
                    ->url(fn (User $record): string => Storage::disk('public')->url($record->payment_proof_path))
                    ->openUrlInNewTab(),
                TextColumn::make('registration_status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'paid' => 'success',
                        'pending', 'pending_review' => 'warning',
                        'rejected' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => ucfirst(str_replace('_', ' ', $state))),
                TextColumn::make('updated_at')->label('Submitted')->dateTime()->sortable(),
                TextColumn::make('registration_paid_at')->label('Approved')->dateTime()->placeholder('—')->sortable()->toggleable(),
            ])
            ->defaultSort('updated_at', 'desc')
            ->filters([
                SelectFilter::make('registration_status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending review',
                        'pending_review' => 'Needs review',
                        'paid' => 'Approved',
                        'rejected' => 'Rejected',
                    ]),
            ])
            ->recordActions([
                Action::make('approve')
                    ->label('Accept')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Accept payment proof')
                    ->modalDescription('This marks the registration as paid.')
                    ->visible(fn (User $record): bool => $record->needsPaymentReview())
                    ->action(function (User $record): void {
                        $record->approvePayment();

                        Notification::make()->title('Payment proof accepted')->success()->send();
                    }),
                Action::make('reject')
                    ->label('Deny')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Deny payment proof')
                    ->modalDescription('This marks the registration as rejected.')
                    ->visible(fn (User $record): bool => $record->needsPaymentReview())
                    ->action(function (User $record): void {
                        $record->rejectPayment();

                        Notification::make()->title('Payment proof denied')->danger()->send();
                    }),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPaymentProofs::route('/'),
        ];
    }
}
