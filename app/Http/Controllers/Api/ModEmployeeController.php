<?php

namespace App\Http\Controllers\Api;

use App\Models\ModEmployee;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ModEmployeeResource;
use App\Http\Resources\ModEmployeeCollection;
use App\Http\Requests\ModEmployeeStoreRequest;
use App\Http\Requests\ModEmployeeUpdateRequest;

class ModEmployeeController extends Controller
{
    public function index(Request $request): ModEmployeeCollection
    {
        $this->authorize('view-any', ModEmployee::class);

        $search = $request->get('search', '');

        $modEmployees = ModEmployee::search($search)
            ->latest()
            ->paginate();

        return new ModEmployeeCollection($modEmployees);
    }

    public function store(ModEmployeeStoreRequest $request): ModEmployeeResource
    {
        $this->authorize('create', ModEmployee::class);

        $validated = $request->validated();

        $modEmployee = ModEmployee::create($validated);

        return new ModEmployeeResource($modEmployee);
    }

    public function show(
        Request $request,
        ModEmployee $modEmployee
    ): ModEmployeeResource {
        $this->authorize('view', $modEmployee);

        return new ModEmployeeResource($modEmployee);
    }

    public function update(
        ModEmployeeUpdateRequest $request,
        ModEmployee $modEmployee
    ): ModEmployeeResource {
        $this->authorize('update', $modEmployee);

        $validated = $request->validated();

        $modEmployee->update($validated);

        return new ModEmployeeResource($modEmployee);
    }

    public function destroy(
        Request $request,
        ModEmployee $modEmployee
    ): Response {
        $this->authorize('delete', $modEmployee);

        $modEmployee->delete();

        return response()->noContent();
    }
}
