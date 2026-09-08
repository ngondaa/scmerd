<?php

use App\Filament\Pages\ManageRegistrationSettings;
use App\Filament\Resources\AppSettings\Pages\ListAppSettings;
use App\Filament\Resources\Reviews\Pages\ListReviews;
use App\Filament\Resources\SubmissionResource\Pages\ListSubmissions;
use App\Filament\Resources\UserResource\Pages\ListUsers;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {
    $this->admin = User::factory()->create(['is_admin' => true]);
    $this->actingAs($this->admin);
});

it('loads filament admin list pages for all site process resources', function () {
    Livewire::test(ListUsers::class)->assertSuccessful();
    Livewire::test(ListSubmissions::class)->assertSuccessful();
    Livewire::test(ListReviews::class)->assertSuccessful();
    Livewire::test(ListAppSettings::class)->assertSuccessful();
    Livewire::test(ManageRegistrationSettings::class)->assertSuccessful();
});

it('can approve a pending payment proof from the users table action', function () {
    $user = User::factory()->create([
        'registration_status' => 'pending',
        'payment_proof_path' => 'payment_proofs/proof.png',
        'registration_paid_at' => null,
    ]);

    Livewire::test(ListUsers::class)
        ->callTableAction('approvePayment', $user)
        ->assertHasNoTableActionErrors();

    expect($user->fresh()->registration_status)->toBe('paid')
        ->and($user->fresh()->registration_paid_at)->not->toBeNull();
});
