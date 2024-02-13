<?php

namespace App\Http\Controllers\Api;

use App\Models\Registrar;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\RegistrarResource;
use App\Http\Resources\RegistrarCollection;
use App\Http\Requests\RegistrarStoreRequest;
use App\Http\Requests\RegistrarUpdateRequest;

class RegistrarController extends Controller
{
    public function index(Request $request): RegistrarCollection
    {
        $this->authorize('view-any', Registrar::class);

        $search = $request->get('search', '');

        $registrars = Registrar::search($search)
            ->latest()
            ->paginate();

        return new RegistrarCollection($registrars);
    }

    public function store(RegistrarStoreRequest $request): RegistrarResource
    {
        $this->authorize('create', Registrar::class);

        $validated = $request->validated();

        $registrar = Registrar::create($validated);

        return new RegistrarResource($registrar);
    }

    public function show(
        Request $request,
        Registrar $registrar
    ): RegistrarResource {
        $this->authorize('view', $registrar);

        return new RegistrarResource($registrar);
    }

    public function update(
        RegistrarUpdateRequest $request,
        Registrar $registrar
    ): RegistrarResource {
        $this->authorize('update', $registrar);

        $validated = $request->validated();

        $registrar->update($validated);

        return new RegistrarResource($registrar);
    }

    public function destroy(Request $request, Registrar $registrar): Response
    {
        $this->authorize('delete', $registrar);

        $registrar->delete();

        return response()->noContent();
    }
}
