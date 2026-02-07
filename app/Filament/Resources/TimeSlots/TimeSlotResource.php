<?php

namespace App\Filament\Resources\TimeSlots;

use App\Filament\Resources\TimeSlots\Pages\CreateTimeSlot;
use App\Filament\Resources\TimeSlots\Pages\EditTimeSlot;
use App\Filament\Resources\TimeSlots\Pages\ListTimeSlots;
use App\Filament\Resources\TimeSlots\Schemas\TimeSlotForm;
use App\Filament\Resources\TimeSlots\Tables\TimeSlotsTable;
use App\Models\TimeSlot;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TimeSlotResource extends Resource
{
    protected static ?string $model = TimeSlot::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Clock;

    protected static string|\UnitEnum|null $navigationGroup = 'Master Data';

    protected static ?int $navigationSort = 4;

    protected static ?string $recordTitleAttribute = 'start_time';

    public static function form(Schema $schema): Schema
    {
        return TimeSlotForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TimeSlotsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTimeSlots::route('/'),
            'create' => CreateTimeSlot::route('/create'),
            'edit' => EditTimeSlot::route('/{record}/edit'),
        ];
    }
}
