<?php

namespace App\Policies;

use App\User;
use App\VirtualNumber;
use Illuminate\Auth\Access\HandlesAuthorization;

class VirtualNumberPolicy extends GeneralPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view the virtualNumber.
     *
     * @param  \App\User $user
     * @param  \App\VirtualNumber $virtualNumber
     * @return mixed
     */
    public function view(User $user, VirtualNumber $virtualNumber)
    {
        //
    }

    /**
     * Determine whether the user can create virtualNumbers.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the virtualNumber.
     *
     * @param  \App\User $user
     * @param  \App\VirtualNumber $virtualNumber
     * @return mixed
     */
    public function update(User $user, VirtualNumber $virtualNumber)
    {
        //
    }

    /**
     * Determine whether the user can delete the virtualNumber.
     *
     * @param  \App\User $user
     * @param  \App\VirtualNumber $virtualNumber
     * @return mixed
     */
    public function delete(User $user, VirtualNumber $virtualNumber)
    {
        //
    }
}
