<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Forum;
use Illuminate\Auth\Access\HandlesAuthorization;

class ForumPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any forums.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true; // Allow viewing forums for any user
    }

    public function manage(User $user)
    {
        return $user->isAdmin();
    }
}
