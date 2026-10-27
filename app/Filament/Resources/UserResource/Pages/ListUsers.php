<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('attendanceConfirmationCampaign')
                ->label('Send attendance confirmation campaign')
                ->icon('heroicon-o-paper-airplane')
                ->url(route('admin.attendance-campaign.preview')),
            Actions\Action::make('unconfirmedAttendanceCampaign')
                ->label('Remind unconfirmed attendees')
                ->icon('heroicon-o-bell-alert')
                ->url(route('admin.unconfirmed-attendance-campaign.preview')),
            Actions\Action::make('exportAttendanceResponses')
                ->label('Export attendance responses')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(fn (): StreamedResponse => response()->streamDownload(function (): void {
                    $output = fopen('php://output', 'w');

                    fputcsv($output, [
                        'Name',
                        'Email',
                        'Attending conference',
                        'Attendance confirmed at',
                        'Attending gala dinner',
                        'Gala dinner confirmed at',
                    ]);

                    User::query()
                        ->where(function ($query): void {
                            $query->whereNotNull('attendance_confirmed_at')
                                ->orWhereNotNull('gala_dinner_confirmed_at');
                        })
                        ->orderBy('name')
                        ->cursor()
                        ->each(function (User $user) use ($output): void {
                            fputcsv($output, array_map(static function ($value): string {
                                $value = (string) ($value ?? '');

                                return preg_match('/^[=+\-@]/', $value) ? "'{$value}" : $value;
                            }, [
                                $user->name,
                                $user->email,
                                $user->attendance_confirmed_at ? 'Yes' : 'No',
                                $user->attendance_confirmed_at?->format('Y-m-d H:i:s'),
                                $user->gala_dinner_confirmed_at ? 'Yes' : 'No',
                                $user->gala_dinner_confirmed_at?->format('Y-m-d H:i:s'),
                            ]));
                        });

                    fclose($output);
                }, 'attendance-confirmations-'.now()->format('Y-m-d').'.csv')),
            Actions\Action::make('exportUsers')
                ->label('Export users')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(fn (): StreamedResponse => response()->streamDownload(function (): void {
                    $output = fopen('php://output', 'w');

                    fputcsv($output, [
                        'Name',
                        'Email',
                        'Package selected',
                        'Registration status',
                        'Proof uploaded',
                        'Registration paid at',
                        'Invoice reference',
                        'Certificate name',
                        'ECSA number',
                        'Student number',
                        'Reviewer',
                        'Payment reviewer',
                        'Admin',
                    ]);

                    User::query()
                        ->orderBy('name')
                        ->cursor()
                        ->each(function (User $user) use ($output): void {
                            fputcsv($output, array_map(static function ($value): string {
                                $value = (string) ($value ?? '');

                                return preg_match('/^[=+\-@]/', $value) ? "'".$value : $value;
                            }, [
                                $user->name,
                                $user->email,
                                UserResource::packageLabel($user->registration_package),
                                UserResource::registrationStatusLabel($user->registration_status),
                                filled($user->payment_proof_path) ? 'Yes' : 'No',
                                $user->registration_paid_at?->format('Y-m-d H:i:s'),
                                $user->payment_invoice_number,
                                $user->certificate_name,
                                $user->ecsa_number,
                                $user->student_id,
                                $user->is_reviewer ? 'Yes' : 'No',
                                $user->is_payment_reviewer ? 'Yes' : 'No',
                                $user->is_admin ? 'Yes' : 'No',
                            ]));
                        });

                    fclose($output);
                }, 'scmerd-users-'.now()->format('Y-m-d').'.csv')),
            Actions\CreateAction::make(),
        ];
    }
}
