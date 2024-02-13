<?php

namespace App\Http\Controllers\Api;

use App\Models\Mod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DecisionResource;
use App\Http\Resources\DecisionCollection;

class ModDecisionsController extends Controller
{
    public function index(Request $request, Mod $mod): DecisionCollection
    {
        $this->authorize('view', $mod);

        $search = $request->get('search', '');

        $decisions = $mod
            ->decisions()
            ->search($search)
            ->latest()
            ->paginate();

        return new DecisionCollection($decisions);
    }

    public function store(Request $request, Mod $mod): DecisionResource
    {
        $this->authorize('create', Decision::class);

        $validated = $request->validate([
            'case_hearing_id' => ['required', 'exists:case_hearings,id'],
            'empID' => ['required', 'max:255', 'string'],
            'name' => ['required', 'max:255', 'string'],
            'chargeType' => ['required', 'max:255', 'string'],
            'caseStartDate' => ['required', 'date'],
            'decisionDate' => ['required', 'date'],
            'decisionType' => ['required', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
        ]);

        $decision = $mod->decisions()->create($validated);

        return new DecisionResource($decision);
    }
}
