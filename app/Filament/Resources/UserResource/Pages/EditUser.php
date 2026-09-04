<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
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
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
