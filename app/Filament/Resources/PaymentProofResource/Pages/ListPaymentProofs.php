<?php

namespace App\Filament\Resources\PaymentProofResource\Pages;

use App\Filament\Resources\PaymentProofResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ListPaymentProofs extends ListRecords
{
    protected static string $resource = PaymentProofResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('exportPaymentProofs')
                ->label('Export payments')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(fn (): StreamedResponse => response()->streamDownload(function (): void {
                    $output = fopen('php://output', 'w');

                    fputcsv($output, [
                        'Registrant',
                        'Email',
                        'Invoice reference',
                        'Package',
                        'Fee',
                        'Certificate name',
                        'ECSA number',
                        'Student number',
                        'Payment status',
                        'Proof submitted',
                        'Payment approved',
                        'Proof file URL',
                    ]);

                    User::query()
                        ->whereNotNull('payment_proof_path')
                        ->orderByDesc('updated_at')
                        ->cursor()
                        ->each(function (User $user) use ($output): void {
                            $package = config('registration.packages.'.$user->registration_package, []);
                            $proofUrl = $user->payment_proof_path
                                ? url(Storage::disk('public')->url($user->payment_proof_path))
                                : null;

                            fputcsv($output, array_map(static function ($value): string {
                                $value = (string) ($value ?? '');

                                return preg_match('/^[=+\-@]/', $value) ? "'".$value : $value;
                            }, [
                                $user->name,
                                $user->email,
                                $user->payment_invoice_number,
                                $package['name'] ?? ucfirst((string) $user->registration_package),
                                $package['display_price'] ?? '',
                                $user->certificate_name,
                                $user->ecsa_number,
                                $user->student_id,
                                $user->registration_status,
                                $user->updated_at?->format('Y-m-d H:i:s'),
                                $user->registration_paid_at?->format('Y-m-d H:i:s'),
                                $proofUrl,
                            ]));
                        });

                    fclose($output);
                }, 'scmerd-payment-proofs-'.now()->format('Y-m-d').'.csv')),
        ];
    }
}
