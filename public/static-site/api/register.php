<?php

require __DIR__ . '/helpers.php';

$config = require __DIR__ . '/config.php';
$data = static_site_require_json();

$package = $data['package'] ?? null;
$allowed = array_keys($config['packages']);

if (! is_string($package) || ! in_array($package, $allowed, true)) {
    static_site_json('error', 'Invalid registration package selected.', [], 422);
}

$required = ['name', 'email', 'certificate_name'];
foreach ($required as $field) {
    if (empty($data[$field])) {
        static_site_json('error', ucfirst($field) . ' is required.', [], 422);
    }
}

if (! filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    static_site_json('error', 'A valid email address is required.', [], 422);
}

if (($data['ecsa_accredited'] ?? false) && empty($data['ecsa_number'] ?? '')) {
    static_site_json('error', 'Please provide an ECSA number when ECSA accredited is selected.', [], 422);
}

$db = static_site_load_db();
$registrations = $db['registrations'];

$registrations[] = [
    'id' => uniqid('reg_', true),
    'name' => trim($data['name']),
    'email' => strtolower(trim($data['email'])),
    'university' => trim($data['university'] ?? ''),
    'discipline' => trim($data['discipline'] ?? ''),
    'package' => $package,
    'certificate_name' => trim($data['certificate_name']),
    'ecsa_accredited' => (bool) ($data['ecsa_accredited'] ?? false),
    'ecsa_number' => trim($data['ecsa_number'] ?? ''),
    'student_id' => trim($data['student_id'] ?? ''),
    'created_at' => date('c'),
];

$db['registrations'] = $registrations;
static_site_save_db($db);

static_site_json('success', 'Registration saved successfully.', [
    'id' => $registrations[array_key_last($registrations)]['id'],
    'name' => $registrations[array_key_last($registrations)]['name'],
    'email' => $registrations[array_key_last($registrations)]['email'],
    'package' => $package,
], 200);
