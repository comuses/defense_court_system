<?php

namespace App\Http\Controllers\Api;

use App\Models\CaseHearing;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\CaseHearingResource;
use App\Http\Resources\CaseHearingCollection;
use App\Http\Requests\CaseHearingStoreRequest;
use App\Http\Requests\CaseHearingUpdateRequest;

class CaseHearingController extends Controller
{
    public function index(Request $request): CaseHearingCollection
    {
        $this->authorize('view-any', CaseHearing::class);

        $search = $request->get('search', '');

        $caseHearings = CaseHearing::search($search)
            ->latest()
            ->paginate();

        return new CaseHearingCollection($caseHearings);
    }

    public function store(CaseHearingStoreRequest $request): CaseHearingResource
    {
        $this->authorize('create', CaseHearing::class);

        $validated = $request->validated();

        $caseHearing = CaseHearing::create($validated);

        return new CaseHearingResource($caseHearing);
    }

    public function show(
        Request $request,
        CaseHearing $caseHearing
    ): CaseHearingResource {
        $this->authorize('view', $caseHearing);

        return new CaseHearingResource($caseHearing);
    }

    public function update(
        CaseHearingUpdateRequest $request,
        CaseHearing $caseHearing
    ): CaseHearingResource {
        $this->authorize('update', $caseHearing);

        $validated = $request->validated();

        $caseHearing->update($validated);

        return new CaseHearingResource($caseHearing);
    }

    public function destroy(
        Request $request,
        CaseHearing $caseHearing
    ): Response {
        $this->authorize('delete', $caseHearing);

        $caseHearing->delete();

        return response()->noContent();
    }
}
