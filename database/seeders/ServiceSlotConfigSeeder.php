<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSlotConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example: Classic Haircut (1) only available in the morning tomorrow
        \App\Models\ServiceSlotConfig::create([
            'service_id' => 1,
            'date' => now()->addDay()->format('Y-m-d'),
            'start_time' => '07:00',
            'end_time' => '12:00',
        ]);

        // Example: Premium Styling (2) only available in the afternoon tomorrow
        \App\Models\ServiceSlotConfig::create([
            'service_id' => 2,
            'date' => now()->addDay()->format('Y-m-d'),
            'start_time' => '12:00',
            'end_time' => '17:00',
        ]);
    }
}
