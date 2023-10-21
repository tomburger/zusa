<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class contributor
{
    use HandlesAuthorization;
    
    public function isContributor(User $user): bool
    {
        return true;
    }
}
