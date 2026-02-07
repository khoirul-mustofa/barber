<?php

namespace App\Filament\Resources\Bookings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Data Pelanggan')
                    ->description('Informasi kontak pelanggan')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->prefixIcon('heroicon-m-user')
                            ->required(),
                        TextInput::make('phone')
                            ->label('Nomor WhatsApp')
                            ->tel()
                            ->prefixIcon('heroicon-m-phone')
                            ->required(),
                        TextInput::make('email')
                            ->label('Email (Opsional)')
                            ->email()
                            ->prefixIcon('heroicon-m-envelope')
                            ->default(null),
                    ])->columns(3),

                Section::make('Detail Booking')
                    ->description('Layanan dan Jadwal')
                    ->schema([
                        Select::make('service_id')
                            ->label('Layanan')
                            ->relationship('service', 'name')
                            ->prefixIcon('heroicon-m-scissors')
                            ->native(false)
                            ->required(),
                        Select::make('barber_id')
                            ->label('Barber')
                            ->relationship('barber', 'name')
                            ->prefixIcon('heroicon-m-user-circle')
                            ->native(false)
                            ->required(),
                        DatePicker::make('booking_date')
                            ->label('Tanggal')
                            ->prefixIcon('heroicon-m-calendar')
                            ->native(false)
                            ->required(),
                        TimePicker::make('booking_time')
                            ->label('Jam')
                            ->prefixIcon('heroicon-m-clock')
                            ->native(false)
                            ->required(),
                    ])->columns(2),

                Section::make('Pembayaran & Status')
                    ->description('Status transaksi dan bukti pembayaran')
                    ->schema([
                        Select::make('status')
                            ->label('Status Booking')
                            ->options(\App\Enums\StatusBookingEnum::class)
                            ->native(false)
                            ->required(),
                        Select::make('payment_method')
                            ->label('Metode Pembayaran')
                            ->options(function () {
                                return \App\Models\PaymentMethod::where('is_active', true)
                                    ->get()
                                    ->mapWithKeys(fn ($method) => [
                                        $method->code->value => $method->name,
                                    ]);
                            })
                            ->native(false)
                            ->required(),

                        FileUpload::make('payment_proof')
                            ->label('Bukti Transfer')
                            ->disk('public')
                            ->directory('payment_proofs')
                            ->image()
                            ->imageEditor()
                            ->maxSize(2048)
                            ->required()
                            ->columnSpanFull(),

                        Textarea::make('notes')
                            ->label('Catatan Tambahan')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }
}
