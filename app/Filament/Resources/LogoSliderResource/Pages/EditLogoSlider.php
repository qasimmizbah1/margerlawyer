<?php

namespace App\Filament\Resources\LogoSliderResource\Pages;

use App\Filament\Resources\LogoSliderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLogoSlider extends EditRecord
{
    protected static string $resource = LogoSliderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
