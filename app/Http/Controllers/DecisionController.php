<?php

namespace App\Http\Controllers;

use App\Models\Mod;
use App\Models\Decision;
use Illuminate\View\View;
use App\Models\CaseHearing;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\DecisionStoreRequest;
use App\Http\Requests\DecisionUpdateRequest;

class DecisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Decision::class);

        $search = $request->get('search', '');

        $decisions = Decision::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.decisions.index', compact('decisions', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Decision::class);

        $mods = Mod::pluck('name', 'id');
        $caseHearings = CaseHearing::pluck('casehearingID', 'id');

        return view('app.decisions.create', compact('mods', 'caseHearings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DecisionStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Decision::class);

        $validated = $request->validated();

        $decision = Decision::create($validated);

        return redirect()
            ->route('decisions.edit', $decision)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Decision $decision): View
    {
        $this->authorize('view', $decision);

        return view('app.decisions.show', compact('decision'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Decision $decision): View
    {
        $this->authorize('update', $decision);

        $mods = Mod::pluck('name', 'id');
        $caseHearings = CaseHearing::pluck('casehearingID', 'id');

        return view(
            'app.decisions.edit',
            compact('decision', 'mods', 'caseHearings')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        DecisionUpdateRequest $request,
        Decision $decision
    ): RedirectResponse {
        $this->authorize('update', $decision);

        $validated = $request->validated();

        $decision->update($validated);

        return redirect()
            ->route('decisions.edit', $decision)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Decision $decision
    ): RedirectResponse {
        $this->authorize('delete', $decision);

        $decision->delete();

        return redirect()
            ->route('decisions.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
