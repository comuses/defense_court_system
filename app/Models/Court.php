<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Court extends Model
{
    use HasFactory;
    use Searchable;

    protected $guarded = [];

    protected $searchableFields = ['*'];

    public function registrars()
    {
        return $this->hasMany(Registrar::class);
    }

    public function attorneys()
    {
        return $this->hasMany(Attorney::class);
    }

    public function judges()
    {
        return $this->hasMany(Judge::class);
    }

    public function bars()
    {
        return $this->hasMany(Bar::class);
    }

    public function caseHearings()
    {
        return $this->hasMany(CaseHearing::class);
    }
}
