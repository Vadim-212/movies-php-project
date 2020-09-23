<?php

namespace App\Policies;

use App\Models\Genre;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GenrePolicy
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
        $admins = config('app.admins');
        if(!isset($admins[$user->id]))
            return false;
        return $user->email == $admins[$user->id];
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Genre  $genre
     * @return mixed
     */
    public function view(User $user, Genre $genre)
    {
        return false;
        /*$admins = config('app.admins');
        if(!isset($admins[$user->id]))
            return false;
        return $user->email == $admins[$user->id];*/
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
     * @param  \App\Models\Genre  $genre
     * @return mixed
     */
    public function update(User $user, Genre $genre)
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
     * @param  \App\Models\Genre  $genre
     * @return mixed
     */
    public function delete(User $user, Genre $genre)
    {
        $admins = config('app.admins');
        if(!isset($admins[$user->id]))
            return false;
        return $user->email == $admins[$user->id];
    }

}
