<?php

namespace App\Filament\Resources\LogoSliderResource\Pages;

use App\Filament\Resources\LogoSliderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLogoSliders extends ListRecords
{
    protected static string $resource = LogoSliderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
