<?php

use App\Models\User;

it('lets payment reviewers view a matching registration invoice', function () {
    $reviewer = User::factory()->create(['is_payment_reviewer' => true]);
    $registrant = User::factory()->create([
        'payment_invoice_number' => 'SCMERD-2026-000123',
        'registration_package' => 'standard',
    ]);

    $this->actingAs($reviewer)
        ->get(route('payment-invoices.show', $registrant))
        ->assertOk()
        ->assertSee('SCMERD-2026-000123')
        ->assertSee('Standard Package');
});

it('does not expose registration invoices to regular users', function () {
    $registrant = User::factory()->create(['payment_invoice_number' => 'SCMERD-2026-000123']);

    $this->actingAs(User::factory()->create())
        ->get(route('payment-invoices.show', $registrant))
        ->assertForbidden();
});
