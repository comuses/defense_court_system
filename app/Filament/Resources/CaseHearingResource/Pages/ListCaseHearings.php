<?php

namespace App\Filament\Resources\CaseHearingResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\CaseHearingResource;

class ListCaseHearings extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = CaseHearingResource::class;
}
