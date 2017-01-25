<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GeneralPolicy
{
    public function before($user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    protected function sameSection(User $user, $item)
    {
        if ($user->section_id !== $item->section_id) {
            return false;
        }
        return true;
    }

    protected function userIsSectionScopedAndSameSection(User $user, $item)
    {
        if (!$user > isSectionScoped()) {
            return false;
        }
        if (!$this->sameSection($user, $item)) {
            return false;
        }
        return true;
    }

    protected function isManagerAndUserIsSectionScopedAndSameSection()
    {
        if (!$user->isManager()) {
            return false;
        }
        if (!$this->userIsSectionScopedAndSameSection($user, $target_user)){
            return false;
        }
        return true;
    }
}
