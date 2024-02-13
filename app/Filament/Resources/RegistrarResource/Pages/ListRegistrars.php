<?php

namespace App\Filament\Resources\RegistrarResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\RegistrarResource;

class ListRegistrars extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = RegistrarResource::class;
}
