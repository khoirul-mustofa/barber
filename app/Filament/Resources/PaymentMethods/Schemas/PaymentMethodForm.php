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
                    ->searchable(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                TextInput::make('account_number')
                    ->maxLength(255),
                TextInput::make('account_name')
                    ->maxLength(255),
                FileUpload::make('icon') // Emoji or Image
                    ->image()
                    ->directory('payment-icons')
                    ->preserveFilenames(),
                FileUpload::make('image') // QRIS or Logo
                    ->label('QRIS/Logo Image')
                    ->image()
                    ->directory('payment-images')
                    ->preserveFilenames(),
                Toggle::make('is_active')
                    ->required()
                    ->default(true),
            ]);
    }
}
