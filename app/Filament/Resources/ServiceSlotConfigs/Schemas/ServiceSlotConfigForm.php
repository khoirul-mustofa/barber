<?php

namespace App\Filament\Resources\ServiceSlotConfigs\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class ServiceSlotConfigForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('service_id')
                    ->label('Layanan')
                    ->relationship('service', 'name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->helperText('Pilih layanan yang ingin dibatasi jamnya.'),
                DatePicker::make('date')
                    ->label('Tanggal')
                    ->required()
                    ->native(false)
                    ->displayFormat('d/m/Y')
                    ->helperText('Pilih tanggal spesifik untuk pengaturan jam ini.'),
                TimePicker::make('start_time')
                    ->label('Jam Mulai')
                    ->required()
                    ->native(false)
                    ->displayFormat('H:i')
                    ->helperText('Jam mulai layanan tersedia (Contoh: 07:00).'),
                TimePicker::make('end_time')
                    ->label('Jam Berakhir')
                    ->required()
                    ->native(false)
                    ->displayFormat('H:i')
                    ->helperText('Jam layanan berakhir (Contoh: 12:00).'),
            ]);
    }
}
