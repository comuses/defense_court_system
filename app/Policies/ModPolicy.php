<?php

namespace App\Policies;

use App\Models\Mod;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the mod can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list mods');
    }

    /**
     * Determine whether the mod can view the model.
     */
    public function view(User $user, Mod $model): bool
    {
        return $user->hasPermissionTo('view mods');
    }

    /**
     * Determine whether the mod can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create mods');
    }

    /**
     * Determine whether the mod can update the model.
     */
    public function update(User $user, Mod $model): bool
    {
        return $user->hasPermissionTo('update mods');
    }

    /**
     * Determine whether the mod can delete the model.
     */
    public function delete(User $user, Mod $model): bool
    {
        return $user->hasPermissionTo('delete mods');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete mods');
    }

    /**
     * Determine whether the mod can restore the model.
     */
    public function restore(User $user, Mod $model): bool
    {
        return false;
    }

    /**
     * Determine whether the mod can permanently delete the model.
     */
    public function forceDelete(User $user, Mod $model): bool
    {
        return false;
    }
}
