<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function afterSave(): void
    {
        if ($this->record->registration_status === 'paid' && ! $this->record->registration_paid_at) {
            $this->record->update(['registration_paid_at' => now()]);
        }

        if ($this->record->registration_status !== 'paid' && $this->record->registration_paid_at) {
            $this->record->update(['registration_paid_at' => null]);
        }
    }

    protected function getHeaderActions(): array
    {
        /** @var User $record */
        $record = $this->getRecord();

        return [
            Actions\Action::make('approvePayment')
                ->label('Approve payment')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->requiresConfirmation()
                ->visible(fn (): bool => $record->needsPaymentReview() || $record->registration_status === 'rejected')
                ->action(function () use ($record): void {
                    $record->approvePayment();
                    $this->refreshFormData(['registration_status', 'registration_paid_at']);

                    Notification::make()
                        ->title('Payment approved')
                        ->success()
                        ->send();
                }),
            Actions\Action::make('rejectPayment')
                ->label('Reject payment')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->requiresConfirmation()
                ->visible(fn (): bool => $record->needsPaymentReview() || $record->registration_status === 'paid')
                ->action(function () use ($record): void {
                    $record->rejectPayment();
                    $this->refreshFormData(['registration_status', 'registration_paid_at']);

                    Notification::make()
                        ->title('Payment rejected')
                        ->danger()
                        ->send();
                }),
            Actions\DeleteAction::make(),
        ];
    }
}
