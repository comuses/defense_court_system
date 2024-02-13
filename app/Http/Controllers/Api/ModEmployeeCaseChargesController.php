<?php

namespace App\Http\Controllers\Api;

use App\Models\ModEmployee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CaseChargeResource;
use App\Http\Resources\CaseChargeCollection;

class ModEmployeeCaseChargesController extends Controller
{
    public function index(
        Request $request,
        ModEmployee $modEmployee
    ): CaseChargeCollection {
        $this->authorize('view', $modEmployee);

        $search = $request->get('search', '');

        $caseCharges = $modEmployee
            ->caseCharges()
            ->search($search)
            ->latest()
            ->paginate();

        return new CaseChargeCollection($caseCharges);
    }

    public function store(
        Request $request,
        ModEmployee $modEmployee
    ): CaseChargeResource {
        $this->authorize('create', CaseCharge::class);

        $validated = $request->validate([
            'mod_id' => ['required', 'exists:mods,id'],
            'rank' => ['required', 'max:255', 'string'],
            'fullName' => ['required', 'max:255', 'string'],
            'address' => ['required', 'max:255', 'string'],
            'state' => ['required', 'max:255', 'string'],
            'crimeType' => ['required', 'max:255', 'string'],
            'crimeDate' => ['required', 'date'],
            'chargeDate' => ['required', 'date'],
            'registrar_id' => ['required', 'exists:registrars,id'],
        ]);

        $caseCharge = $modEmployee->caseCharges()->create($validated);

        return new CaseChargeResource($caseCharge);
    }
}
