<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mod extends Model
{
    use HasFactory;
    use Searchable;

    protected $guarded = [];

    protected $searchableFields = ['*'];

    public function caseCharges()
    {
        return $this->hasMany(CaseCharge::class);
    }

    public function modEmployees()
    {
        return $this->hasMany(ModEmployee::class);
    }

    public function caseHearings()
    {
        return $this->hasMany(CaseHearing::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function decisions()
    {
        return $this->hasMany(Decision::class);
    }
}
