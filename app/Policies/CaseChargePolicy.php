<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CaseCharge;
use Illuminate\Auth\Access\HandlesAuthorization;

class CaseChargePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the caseCharge can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list casecharges');
    }

    /**
     * Determine whether the caseCharge can view the model.
     */
    public function view(User $user, CaseCharge $model): bool
    {
        return $user->hasPermissionTo('view casecharges');
    }

    /**
     * Determine whether the caseCharge can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create casecharges');
    }

    /**
     * Determine whether the caseCharge can update the model.
     */
    public function update(User $user, CaseCharge $model): bool
    {
        return $user->hasPermissionTo('update casecharges');
    }

    /**
     * Determine whether the caseCharge can delete the model.
     */
    public function delete(User $user, CaseCharge $model): bool
    {
        return $user->hasPermissionTo('delete casecharges');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete casecharges');
    }

    /**
     * Determine whether the caseCharge can restore the model.
     */
    public function restore(User $user, CaseCharge $model): bool
    {
        return false;
    }

    /**
     * Determine whether the caseCharge can permanently delete the model.
     */
    public function forceDelete(User $user, CaseCharge $model): bool
    {
        return false;
    }
}
