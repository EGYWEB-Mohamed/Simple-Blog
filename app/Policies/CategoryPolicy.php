<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  User  $user
     * @return Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can('view_any_category');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  User  $user
     * @param  Category  $category
     * @return Response|bool
     */
    public function view(User $user,Category $category)
    {
        return $user->can('view_category');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  User  $user
     * @return Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create_category');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  User  $user
     * @param  Category  $category
     * @return Response|bool
     */
    public function update(User $user,Category $category)
    {
        return $user->can('update_category');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  Category  $category
     * @return Response|bool
     */
    public function delete(User $user,Category $category)
    {
        return $user->can('delete_category');
    }

    /**
     * Determine whether the user can bulk delete.
     *
     * @param  User  $user
     * @return Response|bool
     */
    public function deleteAny(User $user)
    {
        return $user->can('delete_any_category');
    }

    /**
     * Determine whether the user can permanently delete.
     *
     * @param  User  $user
     * @param  Category  $category
     * @return Response|bool
     */
    public function forceDelete(User $user,Category $category)
    {
        return $user->can('force_delete_category');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     *
     * @param  User  $user
     * @return Response|bool
     */
    public function forceDeleteAny(User $user)
    {
        return $user->can('force_delete_any_category');
    }

    /**
     * Determine whether the user can restore.
     *
     * @param  User  $user
     * @param  Category  $category
     * @return Response|bool
     */
    public function restore(User $user,Category $category)
    {
        return $user->can('restore_category');
    }

    /**
     * Determine whether the user can bulk restore.
     *
     * @param  User  $user
     * @return Response|bool
     */
    public function restoreAny(User $user)
    {
        return $user->can('restore_any_category');
    }

    /**
     * Determine whether the user can replicate.
     *
     * @param  User  $user
     * @param  Category  $category
     * @return Response|bool
     */
    public function replicate(User $user,Category $category)
    {
        return $user->can('replicate_category');
    }

    /**
     * Determine whether the user can reorder.
     *
     * @param  User  $user
     * @return Response|bool
     */
    public function reorder(User $user)
    {
        return $user->can('reorder_category');
    }

}
