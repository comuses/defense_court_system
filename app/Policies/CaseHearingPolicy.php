<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CaseHearing;
use Illuminate\Auth\Access\HandlesAuthorization;

class CaseHearingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the caseHearing can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list casehearings');
    }

    /**
     * Determine whether the caseHearing can view the model.
     */
    public function view(User $user, CaseHearing $model): bool
    {
        return $user->hasPermissionTo('view casehearings');
    }

    /**
     * Determine whether the caseHearing can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create casehearings');
    }

    /**
     * Determine whether the caseHearing can update the model.
     */
    public function update(User $user, CaseHearing $model): bool
    {
        return $user->hasPermissionTo('update casehearings');
    }

    /**
     * Determine whether the caseHearing can delete the model.
     */
    public function delete(User $user, CaseHearing $model): bool
    {
        return $user->hasPermissionTo('delete casehearings');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete casehearings');
    }

    /**
     * Determine whether the caseHearing can restore the model.
     */
    public function restore(User $user, CaseHearing $model): bool
    {
        return false;
    }

    /**
     * Determine whether the caseHearing can permanently delete the model.
     */
    public function forceDelete(User $user, CaseHearing $model): bool
    {
        return false;
    }
}
