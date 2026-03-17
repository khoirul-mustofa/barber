<?php

namespace App\Filament\Resources\ServiceSlotConfigs\Pages;

use App\Filament\Resources\ServiceSlotConfigs\ServiceSlotConfigResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditServiceSlotConfig extends EditRecord
{
    protected static string $resource = ServiceSlotConfigResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
