<?php
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Rental;
use App\Models\Playstation;
use App\Models\User;

// Create or get owner user
$owner = User::firstOrCreate(
    ['email' => 'owner@4play.com'],
    [
        'name' => 'Owner 4Play',
        'password' => bcrypt('password'),
        'role' => 'owner'
    ]
);

// Create rental
$rental = Rental::firstOrCreate(
    ['nama_rental' => '4PLAY Rental'],
    [
        'owner_id' => $owner->id,
        'alamat' => 'Jambi',
        'jam_buka' => '09:00',
        'jam_tutup' => '22:00'
    ]
);

// Create playstations
Playstation::create([
    'rental_id' => $rental->id,
    'nomor_ps' => 'PS5 VIP',
    'tipe_ps' => 'PS5',
    'harga_per_jam' => 15000,
    'status' => 'tersedia'
]);

Playstation::create([
    'rental_id' => $rental->id,
    'nomor_ps' => 'PS4 Regular',
    'tipe_ps' => 'PS4',
    'harga_per_jam' => 10000,
    'status' => 'tersedia'
]);

Playstation::create([
    'rental_id' => $rental->id,
    'nomor_ps' => 'PS3 Regular',
    'tipe_ps' => 'PS3',
    'harga_per_jam' => 8000,
    'status' => 'tersedia'
]);

echo "Data playstation berhasil ditambahkan!\n";
