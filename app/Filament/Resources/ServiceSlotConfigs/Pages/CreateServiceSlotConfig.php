<?php

namespace App\Filament\Resources\ServiceSlotConfigs\Pages;

use App\Filament\Resources\ServiceSlotConfigs\ServiceSlotConfigResource;
use Filament\Resources\Pages\CreateRecord;

class CreateServiceSlotConfig extends CreateRecord
{
    protected static string $resource = ServiceSlotConfigResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
