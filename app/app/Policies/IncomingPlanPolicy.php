<?php

namespace App\Policies;

use App\User;
use App\IncomingPlan;
use Illuminate\Auth\Access\HandlesAuthorization;

class IncomingPlanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any incoming plans.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the incoming plan.
     *
     * @param  \App\User  $user
     * @param  \App\IncomingPlan  $IncomingPlan
     * @return mixed
     */
    public function view(User $user, IncomingPlan $incomingPlan)
    {
        return $user->shop_id === $incomingPlan->shop_id;
    }

    /**
     * Determine whether the user can create incoming plans.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the incoming plan.
     *
     * @param  \App\User  $user
     * @param  \App\IncomingPlan  $incomingPlan
     * @return mixed
     */
    public function update(User $user, IncomingPlan $incomingPlan)
    {
        return $user->shop_id === $incomingPlan->shop_id;
    }

    /**
     * Determine whether the user can delete the incoming plan.
     *
     * @param  \App\User  $user
     * @param  \App\IncomingPlan  $incomingPlan
     * @return mixed
     */
    public function delete(User $user, IncomingPlan $incomingPlan)
    {
        return $user->shop_id === $incomingPlan->shop_id;
    }

    /**
     * Determine whether the user can restore the incoming plan.
     *
     * @param  \App\User  $user
     * @param  \App\incomingPlan  $incomingPlan
     * @return mixed
     */
    public function restore(User $user, IncomingPlan $incomingPlan)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the incoming plan.
     *
     * @param  \App\User  $user
     * @param  \App\incomingPlan  $incomingPlan
     * @return mixed
     */
    public function forceDelete(User $user, IncomingPlan $incomingPlan)
    {
        //
    }
}
