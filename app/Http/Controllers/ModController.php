<?php

namespace App\Http\Controllers;

use App\Models\Mod;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ModStoreRequest;
use App\Http\Requests\ModUpdateRequest;

class ModController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Mod::class);

        $search = $request->get('search', '');

        $mods = Mod::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.mods.index', compact('mods', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Mod::class);

        return view('app.mods.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ModStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Mod::class);

        $validated = $request->validated();

        $mod = Mod::create($validated);

        return redirect()
            ->route('mods.edit', $mod)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Mod $mod): View
    {
        $this->authorize('view', $mod);

        return view('app.mods.show', compact('mod'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Mod $mod): View
    {
        $this->authorize('update', $mod);

        return view('app.mods.edit', compact('mod'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ModUpdateRequest $request,
        Mod $mod
    ): RedirectResponse {
        $this->authorize('update', $mod);

        $validated = $request->validated();

        $mod->update($validated);

        return redirect()
            ->route('mods.edit', $mod)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Mod $mod): RedirectResponse
    {
        $this->authorize('delete', $mod);

        $mod->delete();

        return redirect()
            ->route('mods.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
