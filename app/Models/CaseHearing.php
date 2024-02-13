<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CaseHearing extends Model
{
    use HasFactory;
    use Searchable;

    protected $guarded = [];

    protected $searchableFields = ['*'];

    protected $table = 'case_hearings';

    protected $casts = [
        'caseStartDate' => 'datetime',
    ];

    public function attorney()
    {
        return $this->belongsTo(Attorney::class);
    }

    public function court()
    {
        return $this->belongsTo(Court::class);
    }

    public function mod()
    {
        return $this->belongsTo(Mod::class);
    }

    public function judge()
    {
        return $this->belongsTo(Judge::class);
    }

    public function witness()
    {
        return $this->belongsTo(Witness::class);
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
