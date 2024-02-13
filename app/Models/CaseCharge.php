<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CaseCharge extends Model
{
    use HasFactory;
    use Searchable;

    protected $guarded = [];

    protected $searchableFields = ['*'];

    protected $table = 'case_charges';

    protected $hidden = ['registrar_id'];

    protected $casts = [
        'crimeDate' => 'datetime',
        'chargeDate' => 'datetime',
    ];

    public function mod()
    {
        return $this->belongsTo(Mod::class);
    }

    public function modEmployee()
    {
        return $this->belongsTo(ModEmployee::class);
    }

    public function registrar()
    {
        return $this->belongsTo(Registrar::class);
    }
}
