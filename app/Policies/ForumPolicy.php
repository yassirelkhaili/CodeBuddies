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

    /**
     * Determine whether the user can create forums.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can update the Forum.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Forum  $Forum
     * @return mixed
     */
    public function update(User $user, Forum $Forum)
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the Forum.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Forum  $Forum
     * @return mixed
     */
    public function delete(User $user, Forum $Forum)
    {
        return $user->role === 'admin';
    }
}
