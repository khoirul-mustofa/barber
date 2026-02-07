<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ServiceSeeder::class,
            BarberSeeder::class,
            TimeSlotSeeder::class,
            GalerySeeder::class,
            JournalSeeder::class,
            ServiceCategoriesSeeder::class,
            SettingSeeder::class,
            SpecialPackageSeeder::class,
            PaymentMethodSeeder::class,
        ]);
    }
}
