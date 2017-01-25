<?php

namespace App\Policies;

use App\User;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy extends GeneralPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the user.
     *
     * @param  \App\User $user
     * @param  \App\User $target_user
     * @return mixed
     */
    public function view(User $user, User $target_user)
    {
        if (!$user->isManager()) {
            return false;
        }
        if (!$this->userIsSectionScopedAndSameSection($user, $target_user)) {
            return false;
        }
        return true;
    }

    /**
     * Determine whether the user can create users.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        if (!$user->isAdmin()) {
            return false;
        }
        return true;
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param  \App\User $user
     * @param  \App\User $user
     * @return mixed
     */
    public function update(User $user, User $target_user)
    {
        if (!$user->isAdmin()) {
            return false;
        }
        return true;
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param  \App\User $user
     * @param  \App\User $user
     * @return mixed
     */
    public function delete(User $user, User $target_user)
    {
        if (!$user->isAdmin()) {
            return false;
        }
        return true;
    }
}
