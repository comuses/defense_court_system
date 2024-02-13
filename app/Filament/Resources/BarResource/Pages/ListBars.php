<?php

namespace App\Filament\Resources\BarResource\Pages;

use App\Filament\Resources\BarResource;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;

class ListBars extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = BarResource::class;
}
