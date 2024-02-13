<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Decision;
use Illuminate\Auth\Access\HandlesAuthorization;

class DecisionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the decision can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list decisions');
    }

    /**
     * Determine whether the decision can view the model.
     */
    public function view(User $user, Decision $model): bool
    {
        return $user->hasPermissionTo('view decisions');
    }

    /**
     * Determine whether the decision can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create decisions');
    }

    /**
     * Determine whether the decision can update the model.
     */
    public function update(User $user, Decision $model): bool
    {
        return $user->hasPermissionTo('update decisions');
    }

    /**
     * Determine whether the decision can delete the model.
     */
    public function delete(User $user, Decision $model): bool
    {
        return $user->hasPermissionTo('delete decisions');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete decisions');
    }

    /**
     * Determine whether the decision can restore the model.
     */
    public function restore(User $user, Decision $model): bool
    {
        return false;
    }

    /**
     * Determine whether the decision can permanently delete the model.
     */
    public function forceDelete(User $user, Decision $model): bool
    {
        return false;
    }
}
