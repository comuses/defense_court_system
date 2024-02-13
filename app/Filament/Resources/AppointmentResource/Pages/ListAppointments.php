<?php

namespace App\Filament\Resources\AppointmentResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\AppointmentResource;

class ListAppointments extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = AppointmentResource::class;
}
