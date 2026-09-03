<?php

function static_site_json($status, $message, $data = [], $httpCode = 200): void
{
    http_response_code($httpCode);
    header('Content-Type: application/json; charset=utf-8');

    echo json_encode([
        'status' => $status,
        'message' => $message,
        'data' => $data,
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    exit;
}

function static_site_require_json(): array
{
    $raw = file_get_contents('php://input');
    if ($raw === false || trim($raw) === '') {
        static_site_json('error', 'Request body is required.', [], 400);
    }

    $data = json_decode($raw, true);
    if (! is_array($data)) {
        static_site_json('error', 'Invalid JSON payload.', [], 400);
    }

    return $data;
}

function static_site_load_db(): array
{
    $file = __DIR__ . '/../data/data.json';
    if (! file_exists($file)) {
        return [
            'registrations' => [],
            'submissions' => [],
        ];
    }

    $content = file_get_contents($file);
    if ($content === false || trim($content) === '') {
        return [
            'registrations' => [],
            'submissions' => [],
        ];
    }

    $decoded = json_decode($content, true);
    if (! is_array($decoded)) {
        return [
            'registrations' => [],
            'submissions' => [],
        ];
    }

    return [
        'registrations' => $decoded['registrations'] ?? [],
        'submissions' => $decoded['submissions'] ?? [],
    ];
}

function static_site_save_db(array $db): void
{
    $dir = __DIR__ . '/../data';
    if (! is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    $file = $dir . '/data.json';
    file_put_contents($file, json_encode($db, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
}
