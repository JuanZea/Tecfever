<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * @param $user
     * @return bool|null
     */
    public function before($user): ?bool
    {
        if($user->hasRole('admin')) {
            return true;
        }
        return null;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('viewAny_users');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param User $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        return $user->hasPermissionTo('view_users');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create_users');
    }

//    /**
//     * Determine whether the user can store models.
//     *
//     * @param User $user
//     * @return mixed
//     */
//    public function store(User $user)
//    {
//        return $user->hasPermissionTo('store_users');
//    }

    /**
     * Determine whether the user can see edit form.
     *
     * @param User $user
     * @return mixed
     */
    public function edit(User $user)
    {
        return $user->hasPermissionTo('edit_users');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param User $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        return $user->hasPermissionTo('update_users') || $user->id == $model->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param User $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        return $user->hasPermissionTo('destroy_users');
    }
}
