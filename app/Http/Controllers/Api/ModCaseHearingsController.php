<?php

namespace App\Http\Controllers\Api;

use App\Models\Mod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CaseHearingResource;
use App\Http\Resources\CaseHearingCollection;

class ModCaseHearingsController extends Controller
{
    public function index(Request $request, Mod $mod): CaseHearingCollection
    {
        $this->authorize('view', $mod);

        $search = $request->get('search', '');

        $caseHearings = $mod
            ->caseHearings()
            ->search($search)
            ->latest()
            ->paginate();

        return new CaseHearingCollection($caseHearings);
    }

    public function store(Request $request, Mod $mod): CaseHearingResource
    {
        $this->authorize('create', CaseHearing::class);

        $validated = $request->validate([
            'court_id' => ['required', 'exists:courts,id'],
            'attorney_id' => ['required', 'exists:attorneys,id'],
            'judge_id' => ['required', 'exists:judges,id'],
            'witness_id' => ['required', 'exists:witnesses,id'],
            'casehearingID' => ['required', 'max:255', 'string'],
            'chilotname' => ['required', 'max:255', 'string'],
            'fileNumber' => ['required', 'max:255', 'string'],
            'caseStartDate' => ['required', 'date'],
            'address' => ['required', 'max:255', 'string'],
            'state' => ['required', 'max:255', 'string'],
            'location' => ['required', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
            'attoneryWitnessID' => ['required', 'max:255', 'string'],
            'accEmpID' => ['required', 'max:255', 'string'],
        ]);

        $caseHearing = $mod->caseHearings()->create($validated);

        return new CaseHearingResource($caseHearing);
    }
}
