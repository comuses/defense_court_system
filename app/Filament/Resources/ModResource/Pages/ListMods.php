<?php

namespace App\Filament\Resources\ModResource\Pages;

use App\Filament\Resources\ModResource;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;

class ListMods extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = ModResource::class;
}
