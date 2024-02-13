<?php

namespace App\Filament\Resources\AttorneyResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\AttorneyResource;

class ListAttorneys extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = AttorneyResource::class;
}
