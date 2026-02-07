<?php

namespace App\Filament\Resources\Barbers;

use App\Filament\Resources\Barbers\Pages\CreateBarber;
use App\Filament\Resources\Barbers\Pages\EditBarber;
use App\Filament\Resources\Barbers\Pages\ListBarbers;
use App\Filament\Resources\Barbers\Schemas\BarberForm;
use App\Filament\Resources\Barbers\Tables\BarbersTable;
use App\Models\Barber;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BarberResource extends Resource
{
    protected static ?string $model = Barber::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Scissors;

    protected static string|\UnitEnum|null $navigationGroup = 'Master Data';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return BarberForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BarbersTable::configure($table);
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
            'index' => ListBarbers::route('/'),
            'create' => CreateBarber::route('/create'),
            'edit' => EditBarber::route('/{record}/edit'),
        ];
    }
}
