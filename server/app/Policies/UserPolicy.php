<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function isAdmin(User $user): bool
    {
        return $user->profile == "admin";
    }
    public function isController(User $user): bool
    {
        return $user->profile == "controller" || $this->isAdmin($user);
    }
    public function isContributor(User $user): bool
    {
        return $user->profile == "contributor" || $this->isController($user);
    }
    public function isReader(User $user): bool
    {
        return $user->profile == "reader" || $this->isContributor($user);
    }
}
