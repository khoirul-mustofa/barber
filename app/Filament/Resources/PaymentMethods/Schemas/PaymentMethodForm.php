<?php

namespace App\Filament\Resources\PaymentMethods\Schemas;

use App\Enums\PaymentMethods;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PaymentMethodForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('code')
                    ->options(PaymentMethods::class)
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->searchable()
                    ->helperText('Kode unik untuk sistem. Pilih sesuai jenis pembayaran.'),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Contoh: Transfer BCA')
                    ->helperText('Nama yang akan muncul di halaman pembayaran.'),
                Textarea::make('description')
                    ->maxLength(65535)
                    ->columnSpanFull()
                    ->placeholder('Contoh: Silakan transfer ke nomor rekening di bawah ini.')
                    ->helperText('Instruksi singkat untuk pelanggan.'),
                TextInput::make('account_number')
                    ->maxLength(255)
                    ->placeholder('Contoh: 1234567890')
                    ->helperText('Nomor rekening atau nomor virtual account.'),
                TextInput::make('account_name')
                    ->maxLength(255)
                    ->placeholder('Contoh: PT. Nama Perusahaan')
                    ->helperText('Nama pemilik rekening.'),
                FileUpload::make('icon') // Emoji or Image
                    ->image()
                    ->directory('payment-icons')
                    ->disk('public')
                    ->visibility('public')
                    ->helperText('Logo kecil bank/e-wallet. Format: PNG (latar transparan). Rekomendasi ukuran: 100x100px atau rasio 1:1.'),
                FileUpload::make('image') // QRIS or Logo
                    ->label('QRIS Image')
                    ->image()
                    ->disk('public')
                    ->visibility('public')
                    ->directory('payment-images')
                    ->helperText('Upload gambar QRIS. Format: JPG/PNG. Pastikan gambar jelas agar bisa discan. Maksimal 2MB.'),
                Toggle::make('is_active')
                    ->required()
                    ->default(true)
                    ->helperText('Aktifkan metode pembayaran ini?'),
            ]);
    }
}
