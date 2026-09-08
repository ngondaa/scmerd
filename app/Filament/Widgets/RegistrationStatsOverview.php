<?php

namespace App\Filament\Widgets;

use App\Models\AppSetting;
use App\Models\Submission;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RegistrationStatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $registrationOpen = (bool) AppSetting::get('registration_open', '1');
        $pendingProofs = User::query()->needsPaymentReview()->count();
        $paidUsers = User::query()->whereNotNull('registration_paid_at')->count();
        $submissions = Submission::query()->count();

        return [
            Stat::make('Registration', $registrationOpen ? 'Open' : 'Closed')
                ->description($registrationOpen ? 'Authors can upload payment proofs' : 'Proof uploads are disabled')
                ->color($registrationOpen ? 'success' : 'danger'),
            Stat::make('Pending proofs', $pendingProofs)
                ->description('Awaiting approve / reject')
                ->color($pendingProofs > 0 ? 'warning' : 'gray')
                ->url(\App\Filament\Resources\UserResource::getUrl('index')),
            Stat::make('Paid registrations', $paidUsers)
                ->description('Users with registration_paid_at set')
                ->color('success'),
            Stat::make('Submissions', $submissions)
                ->description('Total abstracts in the system')
                ->url(\App\Filament\Resources\SubmissionResource::getUrl('index')),
        ];
    }
}
