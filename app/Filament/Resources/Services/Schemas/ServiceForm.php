<?php

namespace App\Filament\Resources\Services\Schemas;

use App\Models\ServiceCategories;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->default(0),
                TextInput::make('duration')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->suffix('menit'),
                TextInput::make('emoji')
                    ->required(),

                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable()
                    ->createOptionForm([
                        TextInput::make('name')
                            ->required()
                            ->unique(),
                    ])
                    ->createOptionUsing(function (array $data) {
                        return ServiceCategories::create($data)->id;
                    }),
                // desription
                Textarea::make('description')
                    ->label('Deskripsi Singkat')
                    ->rows(3)
                    ->required(),
                DateTimePicker::make('start_date')
                    ->label('Tanggal Mulai')
                    ->helperText('Kapan layanan ini mulai bisa dipesan oleh pelanggan.')
                    ->required()
                    ->native(false)
                    ->default(now()),
                DateTimePicker::make('end_date')
                    ->label('Tanggal Berakhir')
                    ->helperText('Kapan layanan ini otomatis berhenti ditawarkan (tidak bisa dipesan lagi).')
                    ->required()
                    ->native(false)
                    ->default(now()->addYear()),
                Toggle::make('is_active')
                    ->label('Status Aktif')
                    ->helperText('Gunakan ini jika ingin menyembunyikan layanan secara manual dengan cepat.')
                    ->required()
                    ->default(true),
            ]);
    }
}
