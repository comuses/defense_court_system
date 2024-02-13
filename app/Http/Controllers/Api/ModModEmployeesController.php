<?php

namespace App\Http\Controllers\Api;

use App\Models\Mod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ModEmployeeResource;
use App\Http\Resources\ModEmployeeCollection;

class ModModEmployeesController extends Controller
{
    public function index(Request $request, Mod $mod): ModEmployeeCollection
    {
        $this->authorize('view', $mod);

        $search = $request->get('search', '');

        $modEmployees = $mod
            ->modEmployees()
            ->search($search)
            ->latest()
            ->paginate();

        return new ModEmployeeCollection($modEmployees);
    }

    public function store(Request $request, Mod $mod): ModEmployeeResource
    {
        $this->authorize('create', ModEmployee::class);

        $validated = $request->validate([
            'EmpID' => ['required', 'max:255', 'string'],
            'rank' => ['required', 'max:255', 'string'],
            'fullName' => ['required', 'max:255', 'string'],
            'address' => ['required', 'max:255', 'string'],
            'state' => ['required', 'max:255', 'string'],
            'empType' => ['required', 'max:255', 'string'],
        ]);

        $modEmployee = $mod->modEmployees()->create($validated);

        return new ModEmployeeResource($modEmployee);
    }
}
