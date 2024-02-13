<?php

namespace App\Http\Controllers;

use App\Models\Mod;
use Illuminate\View\View;
use App\Models\Registrar;
use App\Models\CaseCharge;
use App\Models\ModEmployee;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CaseChargeStoreRequest;
use App\Http\Requests\CaseChargeUpdateRequest;

class CaseChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', CaseCharge::class);

        $search = $request->get('search', '');

        $caseCharges = CaseCharge::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.case_charges.index', compact('caseCharges', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', CaseCharge::class);

        $modEmployees = ModEmployee::pluck('modID', 'id');
        $mods = Mod::pluck('name', 'id');
        $registrars = Registrar::pluck('MIDNumber', 'id');

        return view(
            'app.case_charges.create',
            compact('modEmployees', 'mods', 'registrars')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CaseChargeStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', CaseCharge::class);

        $validated = $request->validated();

        $caseCharge = CaseCharge::create($validated);

        return redirect()
            ->route('case-charges.edit', $caseCharge)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, CaseCharge $caseCharge): View
    {
        $this->authorize('view', $caseCharge);

        return view('app.case_charges.show', compact('caseCharge'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, CaseCharge $caseCharge): View
    {
        $this->authorize('update', $caseCharge);

        $modEmployees = ModEmployee::pluck('modID', 'id');
        $mods = Mod::pluck('name', 'id');
        $registrars = Registrar::pluck('MIDNumber', 'id');

        return view(
            'app.case_charges.edit',
            compact('caseCharge', 'modEmployees', 'mods', 'registrars')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        CaseChargeUpdateRequest $request,
        CaseCharge $caseCharge
    ): RedirectResponse {
        $this->authorize('update', $caseCharge);

        $validated = $request->validated();

        $caseCharge->update($validated);

        return redirect()
            ->route('case-charges.edit', $caseCharge)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        CaseCharge $caseCharge
    ): RedirectResponse {
        $this->authorize('delete', $caseCharge);

        $caseCharge->delete();

        return redirect()
            ->route('case-charges.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
