<?php
namespace Database\Seeders;

use App\Models\BarangInventaris;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memanggil seeder lainnya
        $this->call([
            JenisBarangSeeder::class,
            UserSeeder::class
        ]);
    }
}
