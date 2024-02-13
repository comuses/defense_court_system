<?php

namespace App\Http\Controllers\Api;

use App\Models\Court;
use Illuminate\Http\Request;
use App\Http\Resources\BarResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\BarCollection;

class CourtBarsController extends Controller
{
    public function index(Request $request, Court $court): BarCollection
    {
        $this->authorize('view', $court);

        $search = $request->get('search', '');

        $bars = $court
            ->bars()
            ->search($search)
            ->latest()
            ->paginate();

        return new BarCollection($bars);
    }

    public function store(Request $request, Court $court): BarResource
    {
        $this->authorize('create', Bar::class);

        $validated = $request->validate([
            'address' => ['required', 'max:255', 'string'],
            'state' => ['required', 'max:255', 'string'],
            'location' => ['required', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
        ]);

        $bar = $court->bars()->create($validated);

        return new BarResource($bar);
    }
}
