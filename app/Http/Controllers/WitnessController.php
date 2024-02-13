<?php

namespace App\Http\Controllers;

use App\Models\Witness;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\WitnessStoreRequest;
use App\Http\Requests\WitnessUpdateRequest;

class WitnessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Witness::class);

        $search = $request->get('search', '');

        $witnesses = Witness::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.witnesses.index', compact('witnesses', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Witness::class);

        return view('app.witnesses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WitnessStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Witness::class);

        $validated = $request->validated();

        $witness = Witness::create($validated);

        return redirect()
            ->route('witnesses.edit', $witness)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Witness $witness): View
    {
        $this->authorize('view', $witness);

        return view('app.witnesses.show', compact('witness'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Witness $witness): View
    {
        $this->authorize('update', $witness);

        return view('app.witnesses.edit', compact('witness'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        WitnessUpdateRequest $request,
        Witness $witness
    ): RedirectResponse {
        $this->authorize('update', $witness);

        $validated = $request->validated();

        $witness->update($validated);

        return redirect()
            ->route('witnesses.edit', $witness)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Witness $witness
    ): RedirectResponse {
        $this->authorize('delete', $witness);

        $witness->delete();

        return redirect()
            ->route('witnesses.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
