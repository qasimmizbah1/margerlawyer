<?php

namespace App\Filament\Resources\GlobalSettingResource\Pages;

use App\Filament\Resources\GlobalSettingResource;
use App\Models\GlobalSetting;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGlobalSetting extends EditRecord
{
    protected static string $resource = GlobalSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->action(function () {
                    // Don't actually delete, just reset
                    $this->record->update(GlobalSetting::defaultSettings());
                })
                ->label('Reset to Default'),
        ];
    }

    protected function resolveRecord(int | string $key): GlobalSetting
    {
        return GlobalSetting::firstOrCreate([], GlobalSetting::defaultSettings());
    }

    public function mount(int | string $record = null): void
    {
        parent::mount(1); // Always use ID 1
    }
}