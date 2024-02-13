<?php

namespace App\Filament\Resources\DecisionResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\DecisionResource;

class ListDecisions extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = DecisionResource::class;
}
