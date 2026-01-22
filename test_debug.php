<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);
$request = \Illuminate\Http\Request::create('/departments/academic', 'GET');
$response = $kernel->handle($request);
echo "STATUS: " . $response->getStatusCode() . "\n";
echo "CONTENT LENGTH: " . strlen($response->getContent()) . "\n";
// Check for sidebar content
$content = $response->getContent();
if (strpos($content, 'department-sidebar') !== false) {
    echo "✓ SIDEBAR HTML FOUND\n";
    // Find and show a snippet
    $start = strpos($content, 'department-sidebar');
    echo "Position: $start\n";
    echo "Snippet: " . substr($content, max(0, $start - 50), 150) . "\n";
} else {
    echo "✗ SIDEBAR HTML NOT FOUND\n";
}
if (strpos($content, 'max-w-7xl') !== false) {
    echo "✓ MAIN CONTENT FOUND\n";
} else {
    echo "✗ MAIN CONTENT NOT FOUND\n";
}
