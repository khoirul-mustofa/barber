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
                    ->relationship('service', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                DatePicker::make('date')
                    ->required()
                    ->native(false)
                    ->displayFormat('d/m/Y'),
                TimePicker::make('start_time')
                    ->required()
                    ->native(false)
                    ->displayFormat('H:i'),
                TimePicker::make('end_time')
                    ->required()
                    ->native(false)
                    ->displayFormat('H:i'),
            ]);
    }
}
