<?php

namespace App\Filament\Resources\ServiceSlotConfigs;

use App\Filament\Resources\ServiceSlotConfigs\Pages\CreateServiceSlotConfig;
use App\Filament\Resources\ServiceSlotConfigs\Pages\EditServiceSlotConfig;
use App\Filament\Resources\ServiceSlotConfigs\Pages\ListServiceSlotConfigs;
use App\Filament\Resources\ServiceSlotConfigs\Schemas\ServiceSlotConfigForm;
use App\Filament\Resources\ServiceSlotConfigs\Tables\ServiceSlotConfigsTable;
use App\Models\ServiceSlotConfig;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ServiceSlotConfigResource extends Resource
{
    protected static ?string $model = ServiceSlotConfig::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Calendar;

    protected static string|\UnitEnum|null $navigationGroup = 'Master Data';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return ServiceSlotConfigForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ServiceSlotConfigsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListServiceSlotConfigs::route('/'),
            'create' => CreateServiceSlotConfig::route('/create'),
            'edit' => EditServiceSlotConfig::route('/{record}/edit'),
        ];
    }
}
