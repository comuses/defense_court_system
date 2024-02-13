<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Witness;
use Illuminate\Auth\Access\HandlesAuthorization;

class WitnessPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the witness can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list witnesses');
    }

    /**
     * Determine whether the witness can view the model.
     */
    public function view(User $user, Witness $model): bool
    {
        return $user->hasPermissionTo('view witnesses');
    }

    /**
     * Determine whether the witness can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create witnesses');
    }

    /**
     * Determine whether the witness can update the model.
     */
    public function update(User $user, Witness $model): bool
    {
        return $user->hasPermissionTo('update witnesses');
    }

    /**
     * Determine whether the witness can delete the model.
     */
    public function delete(User $user, Witness $model): bool
    {
        return $user->hasPermissionTo('delete witnesses');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete witnesses');
    }

    /**
     * Determine whether the witness can restore the model.
     */
    public function restore(User $user, Witness $model): bool
    {
        return false;
    }

    /**
     * Determine whether the witness can permanently delete the model.
     */
    public function forceDelete(User $user, Witness $model): bool
    {
        return false;
    }
}
