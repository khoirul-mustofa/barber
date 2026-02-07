<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'FONNTE_TOKEN',
                'value' => env('FONNTE_TOKEN', 'xxxxx'),
                'type' => 'string',
                'description' => 'Fonnte API Token for WhatsApp integration',
            ],
            [
                'key' => 'ADMIN_PHONE',
                'value' => env('ADMIN_PHONE', '0'),
                'type' => 'string',
                'description' => 'Admin phone number for notifications',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        $this->command->info('Settings seeded successfully!');
    }
}
