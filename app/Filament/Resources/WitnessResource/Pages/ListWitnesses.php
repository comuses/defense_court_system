<?php

namespace App\Filament\Resources\WitnessResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\WitnessResource;

class ListWitnesses extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = WitnessResource::class;
}
