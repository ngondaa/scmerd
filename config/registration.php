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
        'student' => [
            'name' => 'Student Package',
            'description' => 'Day session, gala dinner, 1 CPD credit, certificate of attendance',
            'amount' => 45000,
            'currency' => 'zar',
            'display_price' => 'R450',
        ],
        'standard' => [
            'name' => 'Standard Package',
            'description' => 'Day session, gala dinner, 1 CPD credit, proceedings, networking materials',
            'amount' => 65000,
            'currency' => 'zar',
            'display_price' => 'R650',
        ],
        'premium' => [
            'name' => 'Premium Package',
            'description' => 'Full conference experience with VIP networking and merchandise',
            'amount' => 95000,
            'currency' => 'zar',
            'display_price' => 'R950',
        ],
        'presenter' => [
            'name' => 'Presenter Package',
            'description' => 'Full access, gala dinner, proceedings, and presentation slot',
            'amount' => 75000,
            'currency' => 'zar',
            'display_price' => 'R750',
        ],
    ],

    'payment' => [
        'bank_name' => 'Standard Bank',
        'account_name' => 'SAIMECHE',
        'account_number' => '002089074',
        'branch_name' => 'Eastgate',
        'branch_code' => '018505',
        'electronic_branch_code' => '051001',
        'swift_code' => 'SBZA ZA JJ',
        'reference_prefix' => 'SCMERD',
        'legal_entity' => 'SAIMECHE',
        'account_type' => 'BUSINESS CURRENT ACCOUNT',
        'date_opened' => '02 August 1996',
    ],

];
