<?php

namespace App\Policies;

use App\Models\Action;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActionPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * If a user is an admin or super admin they can approve all actions.
     * If the user owns the company that owns the cafe then they can approve actions.
     *
     * @param \App\User $user
     * @param \App\Models\Action $action
     * @return bool
     */
    public function approve(User $user, Action $action)
    {
        if ($user->permission == 2 || $user->permission == 3) {
            return true;
        } else if ($user->companiesOwned->contains($action->company_id)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * If a user is an admin or super admin they can deny all actions.
     * If the user owns the company that owns the cafe then they can deny actions.
     *
     * @param \App\User $user
     * @param \App\Models\Action $action
     * @return bool
     */
    public function deny(User $user, Action $action)
    {
        if ($user->permission == 2 || $user->permission == 3) {
            return true;
        } else if ($user->companiesOwned->contains($action->company_id)) {
            return true;
        } else {
            return false;
        }
    }
}
