<?php

namespace App\Filament\Resources\MilsCompanionResource\Pages;

use App\Filament\Resources\MilsCompanionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMilsCompanions extends ListRecords
{
    protected static string $resource = MilsCompanionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
