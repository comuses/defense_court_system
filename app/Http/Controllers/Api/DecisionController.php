<?php

namespace App\Http\Controllers\Api;

use App\Models\Decision;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\DecisionResource;
use App\Http\Resources\DecisionCollection;
use App\Http\Requests\DecisionStoreRequest;
use App\Http\Requests\DecisionUpdateRequest;

class DecisionController extends Controller
{
    public function index(Request $request): DecisionCollection
    {
        $this->authorize('view-any', Decision::class);

        $search = $request->get('search', '');

        $decisions = Decision::search($search)
            ->latest()
            ->paginate();

        return new DecisionCollection($decisions);
    }

    public function store(DecisionStoreRequest $request): DecisionResource
    {
        $this->authorize('create', Decision::class);

        $validated = $request->validated();

        $decision = Decision::create($validated);

        return new DecisionResource($decision);
    }

    public function show(Request $request, Decision $decision): DecisionResource
    {
        $this->authorize('view', $decision);

        return new DecisionResource($decision);
    }

    public function update(
        DecisionUpdateRequest $request,
        Decision $decision
    ): DecisionResource {
        $this->authorize('update', $decision);

        $validated = $request->validated();

        $decision->update($validated);

        return new DecisionResource($decision);
    }

    public function destroy(Request $request, Decision $decision): Response
    {
        $this->authorize('delete', $decision);

        $decision->delete();

        return response()->noContent();
    }
}
