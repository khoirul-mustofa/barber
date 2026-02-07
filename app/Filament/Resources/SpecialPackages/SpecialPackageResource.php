<?php

namespace App\Filament\Resources\SpecialPackages;

use App\Filament\Resources\SpecialPackages\Pages\CreateSpecialPackage;
use App\Filament\Resources\SpecialPackages\Pages\EditSpecialPackage;
use App\Filament\Resources\SpecialPackages\Pages\ListSpecialPackages;
use App\Filament\Resources\SpecialPackages\Schemas\SpecialPackageForm;
use App\Filament\Resources\SpecialPackages\Tables\SpecialPackagesTable;
use App\Models\SpecialPackage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SpecialPackageResource extends Resource
{
    protected static ?string $model = SpecialPackage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Star;

    protected static string|\UnitEnum|null $navigationGroup = 'Master Data';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return SpecialPackageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SpecialPackagesTable::configure($table);
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
            'index' => ListSpecialPackages::route('/'),
            'create' => CreateSpecialPackage::route('/create'),
            'edit' => EditSpecialPackage::route('/{record}/edit'),
        ];
    }
}
