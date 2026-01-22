<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    $view = view('SINTAS.operations.dashboard-operations')->render();
    echo "SUCCESS - View rendered\n";
    echo "Length: " . strlen($view) . "\n";
    // Check if sidebar is in output
    if (strpos($view, 'department-sidebar') !== false) {
        echo "✓ Sidebar HTML found!\n";
    } else {
        echo "✗ Sidebar HTML NOT found\n";
    }
    // Check if main content is in output
    if (strpos($view, '<main>') !== false) {
        echo "✓ Main tag found\n";
        // Extract main content
        preg_match('/<main>(.*?)<\/main>/s', $view, $matches);
        if ($matches[1]) {
            echo "Main content length: " . strlen($matches[1]) . "\n";
        } else {
            echo "Main content is EMPTY\n";
        }
    } else {
        echo "✗ Main tag NOT found\n";
    }
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}
