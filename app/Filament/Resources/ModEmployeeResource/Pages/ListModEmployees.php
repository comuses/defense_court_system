<?php

namespace App\Filament\Resources\ModEmployeeResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\ModEmployeeResource;

class ListModEmployees extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = ModEmployeeResource::class;
}
