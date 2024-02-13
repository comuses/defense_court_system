<?php

namespace App\Http\Controllers;

use App\Models\Mod;
use Illuminate\View\View;
use App\Models\ModEmployee;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ModEmployeeStoreRequest;
use App\Http\Requests\ModEmployeeUpdateRequest;

class ModEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ModEmployee::class);

        $search = $request->get('search', '');

        $modEmployees = ModEmployee::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.mod_employees.index',
            compact('modEmployees', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ModEmployee::class);

        $mods = Mod::pluck('name', 'id');

        return view('app.mod_employees.create', compact('mods'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ModEmployeeStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', ModEmployee::class);

        $validated = $request->validated();

        $modEmployee = ModEmployee::create($validated);

        return redirect()
            ->route('mod-employees.edit', $modEmployee)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, ModEmployee $modEmployee): View
    {
        $this->authorize('view', $modEmployee);

        return view('app.mod_employees.show', compact('modEmployee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, ModEmployee $modEmployee): View
    {
        $this->authorize('update', $modEmployee);

        $mods = Mod::pluck('name', 'id');

        return view('app.mod_employees.edit', compact('modEmployee', 'mods'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ModEmployeeUpdateRequest $request,
        ModEmployee $modEmployee
    ): RedirectResponse {
        $this->authorize('update', $modEmployee);

        $validated = $request->validated();

        $modEmployee->update($validated);

        return redirect()
            ->route('mod-employees.edit', $modEmployee)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ModEmployee $modEmployee
    ): RedirectResponse {
        $this->authorize('delete', $modEmployee);

        $modEmployee->delete();

        return redirect()
            ->route('mod-employees.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
