<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class admin
{
    use HandlesAuthorization;

    public function isAdmin(User $user): bool
    {
        return true;
    }
}
