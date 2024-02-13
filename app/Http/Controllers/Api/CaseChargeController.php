<?php

namespace App\Http\Controllers\Api;

use App\Models\CaseCharge;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\CaseChargeResource;
use App\Http\Resources\CaseChargeCollection;
use App\Http\Requests\CaseChargeStoreRequest;
use App\Http\Requests\CaseChargeUpdateRequest;

class CaseChargeController extends Controller
{
    public function index(Request $request): CaseChargeCollection
    {
        $this->authorize('view-any', CaseCharge::class);

        $search = $request->get('search', '');

        $caseCharges = CaseCharge::search($search)
            ->latest()
            ->paginate();

        return new CaseChargeCollection($caseCharges);
    }

    public function store(CaseChargeStoreRequest $request): CaseChargeResource
    {
        $this->authorize('create', CaseCharge::class);

        $validated = $request->validated();

        $caseCharge = CaseCharge::create($validated);

        return new CaseChargeResource($caseCharge);
    }

    public function show(
        Request $request,
        CaseCharge $caseCharge
    ): CaseChargeResource {
        $this->authorize('view', $caseCharge);

        return new CaseChargeResource($caseCharge);
    }

    public function update(
        CaseChargeUpdateRequest $request,
        CaseCharge $caseCharge
    ): CaseChargeResource {
        $this->authorize('update', $caseCharge);

        $validated = $request->validated();

        $caseCharge->update($validated);

        return new CaseChargeResource($caseCharge);
    }

    public function destroy(Request $request, CaseCharge $caseCharge): Response
    {
        $this->authorize('delete', $caseCharge);

        $caseCharge->delete();

        return response()->noContent();
    }
}
