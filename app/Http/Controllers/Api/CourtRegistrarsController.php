<?php

namespace App\Http\Controllers\Api;

use App\Models\Court;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RegistrarResource;
use App\Http\Resources\RegistrarCollection;

class CourtRegistrarsController extends Controller
{
    public function index(Request $request, Court $court): RegistrarCollection
    {
        $this->authorize('view', $court);

        $search = $request->get('search', '');

        $registrars = $court
            ->registrars()
            ->search($search)
            ->latest()
            ->paginate();

        return new RegistrarCollection($registrars);
    }

    public function store(Request $request, Court $court): RegistrarResource
    {
        $this->authorize('create', Registrar::class);

        $validated = $request->validate([
            'MIDNumber' => ['required', 'max:255', 'string'],
            'Rank' => ['required', 'max:255', 'string'],
            'Name' => ['required', 'max:255', 'string'],
            'fieldType' => ['required', 'max:255', 'string'],
            'address' => ['required', 'max:255', 'string'],
            'city' => ['required', 'max:255', 'string'],
            'state' => ['required', 'max:255', 'string'],
        ]);

        $registrar = $court->registrars()->create($validated);

        return new RegistrarResource($registrar);
    }
}
