<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

$depts = ['academic', 'finance', 'hr', 'it', 'operations', 'pr', 'product-rnd', 'sales-marketing', 'engagement-retention'];

foreach ($depts as $dept) {
    $route = "/departments/$dept";
    $request = \Illuminate\Http\Request::create($route, 'GET');
    $response = $kernel->handle($request);
    $content = $response->getContent();
    $hasContent = strpos($content, 'max-w-7xl') !== false;
    $hasSidebar = strpos($content, 'department-sidebar') !== false;
    $icon = ($hasContent && $hasSidebar) ? '✓' : '✗';
    echo "$icon $dept: Main=" . ($hasContent ? 'Y' : 'N') . " Sidebar=" . ($hasSidebar ? 'Y' : 'N') . " Size=" . strlen($content) . "\n";
}
