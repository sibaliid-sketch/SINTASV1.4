<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Welcomeguest\Service;
use App\Models\General\Program;

echo "=== Database Seeding Verification ===\n\n";

echo "Services Count: " . Service::count() . "\n";
echo "Programs Count: " . Program::count() . "\n\n";

echo "=== Services ===\n";
Service::all()->each(function($service) {
    echo "- {$service->name} ({$service->code})\n";
});

echo "\n=== Sample Programs ===\n";
Program::with('service')->take(10)->get()->each(function($program) {
    echo "- {$program->name} ({$program->education_level}) - {$program->service->name}\n";
    echo "  Media: {$program->media}, Location: {$program->class_location}\n";
    echo "  Sessions: {$program->sessions_count}, Price: Rp " . number_format($program->price, 0, ',', '.') . "\n";
    echo "  HPP: Rp " . number_format($program->hpp, 0, ',', '.') . ", Margin: " . number_format((($program->price - $program->hpp) / $program->hpp) * 100, 2) . "%\n\n";
});

echo "=== Programs by Education Level ===\n";
$levels = ['TK/Sederajat', 'SD/Sederajat', 'SMP/Sederajat', 'SMA/Sederajat', 'Mahasiswa', 'Umum'];
foreach ($levels as $level) {
    $count = Program::where('education_level', $level)->count();
    echo "- {$level}: {$count} programs\n";
}

echo "\n✅ Verification Complete!\n";
