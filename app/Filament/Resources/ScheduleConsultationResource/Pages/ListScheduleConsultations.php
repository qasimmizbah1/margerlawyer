<?php

namespace App\Filament\Resources\ScheduleConsultationResource\Pages;

use App\Filament\Resources\ScheduleConsultationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListScheduleConsultations extends ListRecords
{
    protected static string $resource = ScheduleConsultationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
