<?php

namespace App\Http\Controllers\Api;

use App\Models\Mod;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\ModResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\ModCollection;
use App\Http\Requests\ModStoreRequest;
use App\Http\Requests\ModUpdateRequest;

class ModController extends Controller
{
    public function index(Request $request): ModCollection
    {
        $this->authorize('view-any', Mod::class);

        $search = $request->get('search', '');

        $mods = Mod::search($search)
            ->latest()
            ->paginate();

        return new ModCollection($mods);
    }

    public function store(ModStoreRequest $request): ModResource
    {
        $this->authorize('create', Mod::class);

        $validated = $request->validated();

        $mod = Mod::create($validated);

        return new ModResource($mod);
    }

    public function show(Request $request, Mod $mod): ModResource
    {
        $this->authorize('view', $mod);

        return new ModResource($mod);
    }

    public function update(ModUpdateRequest $request, Mod $mod): ModResource
    {
        $this->authorize('update', $mod);

        $validated = $request->validated();

        $mod->update($validated);

        return new ModResource($mod);
    }

    public function destroy(Request $request, Mod $mod): Response
    {
        $this->authorize('delete', $mod);

        $mod->delete();

        return response()->noContent();
    }
}
