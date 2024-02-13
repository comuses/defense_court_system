<?php

namespace App\Filament\Resources\JudgeResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\JudgeResource;
use App\Filament\Traits\HasDescendingOrder;

class ListJudges extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = JudgeResource::class;
}
