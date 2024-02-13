<?php

namespace App\Http\Controllers\Api;

use App\Models\Mod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CaseChargeResource;
use App\Http\Resources\CaseChargeCollection;

class ModCaseChargesController extends Controller
{
    public function index(Request $request, Mod $mod): CaseChargeCollection
    {
        $this->authorize('view', $mod);

        $search = $request->get('search', '');

        $caseCharges = $mod
            ->caseCharges()
            ->search($search)
            ->latest()
            ->paginate();

        return new CaseChargeCollection($caseCharges);
    }

    public function store(Request $request, Mod $mod): CaseChargeResource
    {
        $this->authorize('create', CaseCharge::class);

        $validated = $request->validate([
            'mod_employee_id' => ['required', 'exists:mod_employees,id'],
            'rank' => ['required', 'max:255', 'string'],
            'fullName' => ['required', 'max:255', 'string'],
            'address' => ['required', 'max:255', 'string'],
            'state' => ['required', 'max:255', 'string'],
            'crimeType' => ['required', 'max:255', 'string'],
            'crimeDate' => ['required', 'date'],
            'chargeDate' => ['required', 'date'],
            'registrar_id' => ['required', 'exists:registrars,id'],
        ]);

        $caseCharge = $mod->caseCharges()->create($validated);

        return new CaseChargeResource($caseCharge);
    }
}
