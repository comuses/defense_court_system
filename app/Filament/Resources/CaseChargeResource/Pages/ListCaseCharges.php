<?php

namespace App\Filament\Resources\CaseChargeResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\CaseChargeResource;

class ListCaseCharges extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = CaseChargeResource::class;
}
