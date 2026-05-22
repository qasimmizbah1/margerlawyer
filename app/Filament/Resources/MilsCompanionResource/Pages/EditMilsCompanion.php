<?php

namespace App\Filament\Resources\MilsCompanionResource\Pages;

use App\Filament\Resources\MilsCompanionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMilsCompanion extends EditRecord
{
    protected static string $resource = MilsCompanionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
