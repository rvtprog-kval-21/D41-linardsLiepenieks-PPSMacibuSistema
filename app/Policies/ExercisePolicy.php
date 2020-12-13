<?php

namespace App\Policies;

use App\Models\User;
use App\Models\exercise;
use http\Env\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExercisePolicy
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
        die("create");
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\exercise  $exercise
     * @return mixed
     */
    public function view(User $user, exercise $exercise)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->admin == true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\exercise  $exercise
     * @return mixed
     */
    public function update(User $user, exercise $exercise)
    {
        die("update");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\exercise  $exercise
     * @return mixed
     */
    public function delete(User $user, exercise $exercise)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\exercise  $exercise
     * @return mixed
     */
    public function restore(User $user, exercise $exercise)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\exercise  $exercise
     * @return mixed
     */
    public function forceDelete(User $user, exercise $exercise)
    {
        //
    }
}
