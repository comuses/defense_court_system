<?php

namespace App\Http\Controllers;

use App\Models\Mod;
use App\Models\Court;
use App\Models\Judge;
use App\Models\Witness;
use App\Models\Attorney;
use Illuminate\View\View;
use App\Models\CaseHearing;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CaseHearingStoreRequest;
use App\Http\Requests\CaseHearingUpdateRequest;

class CaseHearingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', CaseHearing::class);

        $search = $request->get('search', '');

        $caseHearings = CaseHearing::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.case_hearings.index',
            compact('caseHearings', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', CaseHearing::class);

        $courts = Court::pluck('name', 'id');
        $mods = Mod::pluck('name', 'id');
        $attorneys = Attorney::pluck('courtID', 'id');
        $judges = Judge::pluck('name', 'id');
        $witnesses = Witness::pluck('name', 'id');

        return view(
            'app.case_hearings.create',
            compact('courts', 'mods', 'attorneys', 'judges', 'witnesses')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CaseHearingStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', CaseHearing::class);

        $validated = $request->validated();

        $caseHearing = CaseHearing::create($validated);

        return redirect()
            ->route('case-hearings.edit', $caseHearing)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, CaseHearing $caseHearing): View
    {
        $this->authorize('view', $caseHearing);

        return view('app.case_hearings.show', compact('caseHearing'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, CaseHearing $caseHearing): View
    {
        $this->authorize('update', $caseHearing);

        $courts = Court::pluck('name', 'id');
        $mods = Mod::pluck('name', 'id');
        $attorneys = Attorney::pluck('courtID', 'id');
        $judges = Judge::pluck('name', 'id');
        $witnesses = Witness::pluck('name', 'id');

        return view(
            'app.case_hearings.edit',
            compact(
                'caseHearing',
                'courts',
                'mods',
                'attorneys',
                'judges',
                'witnesses'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        CaseHearingUpdateRequest $request,
        CaseHearing $caseHearing
    ): RedirectResponse {
        $this->authorize('update', $caseHearing);

        $validated = $request->validated();

        $caseHearing->update($validated);

        return redirect()
            ->route('case-hearings.edit', $caseHearing)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        CaseHearing $caseHearing
    ): RedirectResponse {
        $this->authorize('delete', $caseHearing);

        $caseHearing->delete();

        return redirect()
            ->route('case-hearings.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
