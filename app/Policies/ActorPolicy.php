<?php

namespace App\Policies;

use App\Models\Actor;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use function PHPUnit\Framework\isEmpty;

class ActorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Actor  $actor
     * @return mixed
     */
    public function view(User $user, Actor $actor)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $admins = config('app.admins');
        if(!isset($admins[$user->id]))
            return false;
        return $user->email == $admins[$user->id];
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Actor  $actor
     * @return mixed
     */
    public function update(User $user, Actor $actor)
    {
        $admins = config('app.admins');
        if(!isset($admins[$user->id]))
            return false;
        return $user->email == $admins[$user->id];
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Actor  $actor
     * @return mixed
     */
    public function delete(User $user, Actor $actor)
    {
        $admins = config('app.admins');
        if(!isset($admins[$user->id]))
            return false;
        return $user->email == $admins[$user->id];
    }
}
