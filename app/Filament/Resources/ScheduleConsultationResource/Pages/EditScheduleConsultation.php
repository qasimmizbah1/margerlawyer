<?php

namespace App\Filament\Resources\ScheduleConsultationResource\Pages;

use App\Filament\Resources\ScheduleConsultationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditScheduleConsultation extends EditRecord
{
    protected static string $resource = ScheduleConsultationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
