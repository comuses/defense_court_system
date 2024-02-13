<?php

namespace App\Http\Controllers\Api;

use App\Models\Witness;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\WitnessResource;
use App\Http\Resources\WitnessCollection;
use App\Http\Requests\WitnessStoreRequest;
use App\Http\Requests\WitnessUpdateRequest;

class WitnessController extends Controller
{
    public function index(Request $request): WitnessCollection
    {
        $this->authorize('view-any', Witness::class);

        $search = $request->get('search', '');

        $witnesses = Witness::search($search)
            ->latest()
            ->paginate();

        return new WitnessCollection($witnesses);
    }

    public function store(WitnessStoreRequest $request): WitnessResource
    {
        $this->authorize('create', Witness::class);

        $validated = $request->validated();

        $witness = Witness::create($validated);

        return new WitnessResource($witness);
    }

    public function show(Request $request, Witness $witness): WitnessResource
    {
        $this->authorize('view', $witness);

        return new WitnessResource($witness);
    }

    public function update(
        WitnessUpdateRequest $request,
        Witness $witness
    ): WitnessResource {
        $this->authorize('update', $witness);

        $validated = $request->validated();

        $witness->update($validated);

        return new WitnessResource($witness);
    }

    public function destroy(Request $request, Witness $witness): Response
    {
        $this->authorize('delete', $witness);

        $witness->delete();

        return response()->noContent();
    }
}
