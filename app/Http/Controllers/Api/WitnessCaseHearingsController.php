<?php

namespace App\Http\Controllers\Api;

use App\Models\Witness;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CaseHearingResource;
use App\Http\Resources\CaseHearingCollection;

class WitnessCaseHearingsController extends Controller
{
    public function index(
        Request $request,
        Witness $witness
    ): CaseHearingCollection {
        $this->authorize('view', $witness);

        $search = $request->get('search', '');

        $caseHearings = $witness
            ->caseHearings()
            ->search($search)
            ->latest()
            ->paginate();

        return new CaseHearingCollection($caseHearings);
    }

    public function store(
        Request $request,
        Witness $witness
    ): CaseHearingResource {
        $this->authorize('create', CaseHearing::class);

        $validated = $request->validate([
            'court_id' => ['required', 'exists:courts,id'],
            'mod_id' => ['required', 'exists:mods,id'],
            'attorney_id' => ['required', 'exists:attorneys,id'],
            'judge_id' => ['required', 'exists:judges,id'],
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

        $caseHearing = $witness->caseHearings()->create($validated);

        return new CaseHearingResource($caseHearing);
    }
}
