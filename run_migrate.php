<?php
// Simple migration runner to bypass terminal pager issues
require __DIR__ . '/bootstrap/app.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);

// Run migrations
$status = $kernel->call('migrate', ['--verbose' => false]);

echo "\n✓ Migrations completed with status: " . $status . "\n";
