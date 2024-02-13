<?php

namespace App\Http\Controllers\Api;

use App\Models\Registrar;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserCollection;

class RegistrarUsersController extends Controller
{
    public function index(
        Request $request,
        Registrar $registrar
    ): UserCollection {
        $this->authorize('view', $registrar);

        $search = $request->get('search', '');

        $users = $registrar
            ->users()
            ->search($search)
            ->latest()
            ->paginate();

        return new UserCollection($users);
    }

    public function store(Request $request, Registrar $registrar): UserResource
    {
        $this->authorize('create', User::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'email' => ['required', 'unique:users,email', 'email'],
            'password' => ['required'],
            'description' => ['nullable', 'max:255', 'string'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = $registrar->users()->create($validated);

        $user->syncRoles($request->roles);

        return new UserResource($user);
    }
}
