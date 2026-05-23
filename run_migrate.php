<?php
/**
 * Script darurat untuk menjalankan migrasi dan seeder.
 * Hapus file ini setelah dijalankan!
 * Jalankan: php run_migrate.php
 */

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Menjalankan migrate:fresh --seed ===\n";

// Hapus semua tabel dan buat ulang
$exitCode = Illuminate\Support\Facades\Artisan::call('migrate:fresh', [
    '--seed' => true,
    '--force' => true,
    '--no-interaction' => true,
]);

echo Illuminate\Support\Facades\Artisan::output();

if ($exitCode === 0) {
    echo "\n✅ Migrasi dan seeder berhasil dijalankan!\n";
} else {
    echo "\n❌ Terjadi error. Exit code: {$exitCode}\n";
}
