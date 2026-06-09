<?php
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Playstation;

try {
    $count = Playstation::count();
    echo "Total playstation: " . $count . "\n";
    
    $playstations = Playstation::all();
    foreach ($playstations as $ps) {
        echo "- {$ps->nomor_ps} ({$ps->tipe_ps}): Rp" . number_format($ps->harga_per_jam) . "\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}
