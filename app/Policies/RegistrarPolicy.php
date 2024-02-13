<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Registrar;
use Illuminate\Auth\Access\HandlesAuthorization;

class RegistrarPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the registrar can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list registrars');
    }

    /**
     * Determine whether the registrar can view the model.
     */
    public function view(User $user, Registrar $model): bool
    {
        return $user->hasPermissionTo('view registrars');
    }

    /**
     * Determine whether the registrar can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create registrars');
    }

    /**
     * Determine whether the registrar can update the model.
     */
    public function update(User $user, Registrar $model): bool
    {
        return $user->hasPermissionTo('update registrars');
    }

    /**
     * Determine whether the registrar can delete the model.
     */
    public function delete(User $user, Registrar $model): bool
    {
        return $user->hasPermissionTo('delete registrars');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete registrars');
    }

    /**
     * Determine whether the registrar can restore the model.
     */
    public function restore(User $user, Registrar $model): bool
    {
        return false;
    }

    /**
     * Determine whether the registrar can permanently delete the model.
     */
    public function forceDelete(User $user, Registrar $model): bool
    {
        return false;
    }
}
