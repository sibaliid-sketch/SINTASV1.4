<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    $view = view('SINTAS.operations.operations-sidebar')->render();
    echo "Sidebar length: " . strlen($view) . "\n";
    if (strlen($view) < 100) {
        echo "Sidebar is EMPTY or very small!\n";
        echo "Content: " . $view . "\n";
    } else {
        echo "✓ Sidebar rendered: " . strlen($view) . " bytes\n";
        if (strpos($view, 'department-sidebar') !== false) {
            echo "✓ Contains department-sidebar\n";
        }
    }
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
