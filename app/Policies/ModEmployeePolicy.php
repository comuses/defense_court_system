<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ModEmployee;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModEmployeePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the modEmployee can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list modemployees');
    }

    /**
     * Determine whether the modEmployee can view the model.
     */
    public function view(User $user, ModEmployee $model): bool
    {
        return $user->hasPermissionTo('view modemployees');
    }

    /**
     * Determine whether the modEmployee can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create modemployees');
    }

    /**
     * Determine whether the modEmployee can update the model.
     */
    public function update(User $user, ModEmployee $model): bool
    {
        return $user->hasPermissionTo('update modemployees');
    }

    /**
     * Determine whether the modEmployee can delete the model.
     */
    public function delete(User $user, ModEmployee $model): bool
    {
        return $user->hasPermissionTo('delete modemployees');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete modemployees');
    }

    /**
     * Determine whether the modEmployee can restore the model.
     */
    public function restore(User $user, ModEmployee $model): bool
    {
        return false;
    }

    /**
     * Determine whether the modEmployee can permanently delete the model.
     */
    public function forceDelete(User $user, ModEmployee $model): bool
    {
        return false;
    }
}
