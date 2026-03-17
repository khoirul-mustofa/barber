<?php

namespace App\Filament\Resources\ServiceSlotConfigs\Pages;

use App\Filament\Resources\ServiceSlotConfigs\ServiceSlotConfigResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListServiceSlotConfigs extends ListRecords
{
    protected static string $resource = ServiceSlotConfigResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
