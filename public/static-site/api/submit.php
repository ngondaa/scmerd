<?php

require __DIR__ . '/helpers.php';

$data = static_site_require_json();

foreach (['presenter', 'affiliation', 'title', 'track', 'abstract'] as $field) {
    if (empty($data[$field])) {
        static_site_json('error', ucfirst($field) . ' is required.', [], 422);
    }
}

$db = static_site_load_db();
$submissions = $db['submissions'];

$submissions[] = [
    'id' => uniqid('sub_', true),
    'presenter' => trim($data['presenter']),
    'affiliation' => trim($data['affiliation']),
    'title' => trim($data['title']),
    'track' => trim($data['track']),
    'abstract' => trim($data['abstract']),
    'keywords' => trim($data['keywords'] ?? ''),
    'created_at' => date('c'),
];

$db['submissions'] = $submissions;
static_site_save_db($db);

static_site_json('success', 'Abstract submitted successfully.', [
    'id' => $submissions[array_key_last($submissions)]['id'],
    'title' => $submissions[array_key_last($submissions)]['title'],
    'presenter' => $submissions[array_key_last($submissions)]['presenter'],
], 200);
