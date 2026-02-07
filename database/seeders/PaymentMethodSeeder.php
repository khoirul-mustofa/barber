<?php

namespace Database\Seeders;

use App\Enums\PaymentMethods;
use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = [
            [
                'code' => PaymentMethods::BCA,
                'name' => 'Transfer BCA',
                'description' => '123-456-7890',
                'account_number' => '123-456-7890',
                'account_name' => 'Admin Kuga',
                'icon' => '🏦',
                'is_active' => true,
            ],
            [
                'code' => PaymentMethods::MANDIRI,
                'name' => 'Transfer Mandiri',
                'description' => '987-654-3210',
                'account_number' => '987-654-3210',
                'account_name' => 'Admin Kuga',
                'icon' => '🏦',
                'is_active' => true,
            ],
            [
                'code' => PaymentMethods::BNI,
                'name' => 'Transfer BNI',
                'description' => '123-456-7890',
                'account_number' => '123-456-7890',
                'account_name' => 'Admin Kuga',
                'icon' => '📱',
                'is_active' => true,
            ],
            [
                'code' => PaymentMethods::DANA,
                'name' => 'DANA',
                'description' => '0812-5662-6112',
                'account_number' => '0812-5662-6112',
                'account_name' => 'Admin Kuga',
                'icon' => '📱',
                'is_active' => true,
            ],
            [
                'code' => PaymentMethods::QRIS,
                'name' => 'QRIS',
                'description' => 'Scan Barcode',
                'icon' => '📸',
                'image' => 'images/qr-code.svg', // Will need to be handled if used
                'is_active' => true,
            ],
        ];

        foreach ($methods as $method) {
            PaymentMethod::updateOrCreate(
                ['code' => $method['code']],
                $method
            );
        }
    }
}
