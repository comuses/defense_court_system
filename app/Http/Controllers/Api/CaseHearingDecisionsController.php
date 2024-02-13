<?php

namespace App\Http\Controllers\Api;

use App\Models\CaseHearing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DecisionResource;
use App\Http\Resources\DecisionCollection;

class CaseHearingDecisionsController extends Controller
{
    public function index(
        Request $request,
        CaseHearing $caseHearing
    ): DecisionCollection {
        $this->authorize('view', $caseHearing);

        $search = $request->get('search', '');

        $decisions = $caseHearing
            ->decisions()
            ->search($search)
            ->latest()
            ->paginate();

        return new DecisionCollection($decisions);
    }

    public function store(
        Request $request,
        CaseHearing $caseHearing
    ): DecisionResource {
        $this->authorize('create', Decision::class);

        $validated = $request->validate([
            'mod_id' => ['required', 'exists:mods,id'],
            'empID' => ['required', 'max:255', 'string'],
            'name' => ['required', 'max:255', 'string'],
            'chargeType' => ['required', 'max:255', 'string'],
            'caseStartDate' => ['required', 'date'],
            'decisionDate' => ['required', 'date'],
            'decisionType' => ['required', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
        ]);

        $decision = $caseHearing->decisions()->create($validated);

        return new DecisionResource($decision);
    }
}
