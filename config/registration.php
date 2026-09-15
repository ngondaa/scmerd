<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Conference registration packages
    |--------------------------------------------------------------------------
    |
    | Amounts are in the smallest currency unit (cents for ZAR).
    | Keys must match the package values used on the dashboard.
    |
    */

    'packages' => [
        'student_member_conference' => ['name' => 'SAIMechE Student', 'description' => 'Conference attendance only', 'amount' => 45000, 'currency' => 'zar', 'display_price' => 'R450', 'category' => 'Student packages'],
        'student_non_member_conference' => ['name' => 'Non-SAIMechE Student', 'description' => 'Conference attendance only', 'amount' => 65000, 'currency' => 'zar', 'display_price' => 'R650', 'category' => 'Student packages'],
        'student_member_conference_gala' => ['name' => 'SAIMechE Student — Conference & Gala Dinner', 'description' => 'Conference attendance and gala dinner', 'amount' => 100000, 'currency' => 'zar', 'display_price' => 'R1 000', 'category' => 'Conference & gala dinner attendance'],
        'student_non_member_conference_gala' => ['name' => 'Non-SAIMechE Student — Conference & Gala Dinner', 'description' => 'Conference attendance and gala dinner', 'amount' => 135000, 'currency' => 'zar', 'display_price' => 'R1 350', 'category' => 'Conference & gala dinner attendance'],
        'standard_member_conference' => ['name' => 'Standard — SAIMechE Member', 'description' => 'Conference attendance only', 'amount' => 95000, 'currency' => 'zar', 'display_price' => 'R950', 'category' => 'Standard packages'],
        'standard_non_member_conference' => ['name' => 'Standard — Non-SAIMechE Member', 'description' => 'Conference attendance only', 'amount' => 100000, 'currency' => 'zar', 'display_price' => 'R1 000', 'category' => 'Standard packages'],
        'full_member' => ['name' => 'Full Conference — SAIMechE Member', 'description' => 'Full conference package', 'amount' => 165000, 'currency' => 'zar', 'display_price' => 'R1 650', 'category' => 'Full packages'],
        'full_non_member' => ['name' => 'Full Conference — Non-SAIMechE Member', 'description' => 'Full conference package', 'amount' => 185000, 'currency' => 'zar', 'display_price' => 'R1 850', 'category' => 'Full packages'],

        // Existing registrations retain their original package and price. These options are not shown for new registrations.
        'just_attend' => ['name' => 'Just Attend Package', 'description' => 'Legacy registration package', 'amount' => 45000, 'currency' => 'zar', 'display_price' => 'R450', 'available' => false],
        'standard' => ['name' => 'Standard Package', 'description' => 'Legacy registration package', 'amount' => 65000, 'currency' => 'zar', 'display_price' => 'R650', 'available' => false],
        'premium' => ['name' => 'Premium Package', 'description' => 'Legacy registration package', 'amount' => 95000, 'currency' => 'zar', 'display_price' => 'R950', 'available' => false],
        'presenter' => ['name' => 'Presenter Package', 'description' => 'Legacy registration package', 'amount' => 75000, 'currency' => 'zar', 'display_price' => 'R750', 'available' => false],
    ],

    'payment' => [
        // Carey is the finance owner and must receive every invoice/proof pair.
        'proof_recipients' => array_values(array_unique(array_filter(array_map(
            'trim',
            [
                'carey@saimeche.org.za',
                ...explode(',', env('PAYMENT_PROOF_RECIPIENTS', 'ngondaa@yahoo.com')),
            ],
        )))),
        'bank_name' => 'Standard Bank',
        'account_name' => 'SAIMECHE',
        'account_number' => '002089074',
        'branch_name' => 'Eastgate',
        'branch_code' => '018505',
        'electronic_branch_code' => '051001',
        'swift_code' => 'SBZA ZA JJ',
        'reference_prefix' => 'Central Branch',
        'legal_entity' => 'SAIMECHE',
        'account_type' => 'BUSINESS CURRENT ACCOUNT',
        'date_opened' => '02 August 1996',
    ],

];
