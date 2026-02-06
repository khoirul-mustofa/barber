<?php

namespace Database\Seeders;

use App\Models\User;
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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
        ]);
        $this->call([
            ServiceSeeder::class,
            BarberSeeder::class,
            TimeSlotSeeder::class,
            GalerySeeder::class,
            JournalSeeder::class,
            ServiceCategoriesSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
