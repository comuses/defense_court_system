<?php

namespace App\Http\Controllers;

use App\Models\Court;
use App\Models\Registrar;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\RegistrarStoreRequest;
use App\Http\Requests\RegistrarUpdateRequest;

class RegistrarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Registrar::class);

        $search = $request->get('search', '');

        $registrars = Registrar::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.registrars.index', compact('registrars', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Registrar::class);

        $courts = Court::pluck('name', 'id');

        return view('app.registrars.create', compact('courts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegistrarStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Registrar::class);

        $validated = $request->validated();

        $registrar = Registrar::create($validated);

        return redirect()
            ->route('registrars.edit', $registrar)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Registrar $registrar): View
    {
        $this->authorize('view', $registrar);

        return view('app.registrars.show', compact('registrar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Registrar $registrar): View
    {
        $this->authorize('update', $registrar);

        $courts = Court::pluck('name', 'id');

        return view('app.registrars.edit', compact('registrar', 'courts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        RegistrarUpdateRequest $request,
        Registrar $registrar
    ): RedirectResponse {
        $this->authorize('update', $registrar);

        $validated = $request->validated();

        $registrar->update($validated);

        return redirect()
            ->route('registrars.edit', $registrar)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Registrar $registrar
    ): RedirectResponse {
        $this->authorize('delete', $registrar);

        $registrar->delete();

        return redirect()
            ->route('registrars.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
