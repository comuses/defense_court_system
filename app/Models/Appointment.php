<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;
    use Searchable;

    protected $guarded = [];

    protected $searchableFields = ['*'];

    protected $casts = [
        'appointmentDate' => 'datetime',
    ];

    public function mod()
    {
        return $this->belongsTo(Mod::class);
    }

    public function caseHearing()
    {
        return $this->belongsTo(CaseHearing::class);
    }
}
