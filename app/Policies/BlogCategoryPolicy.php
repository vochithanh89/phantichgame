<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\BlogCategory;
use App\Models\User;

class BlogCategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any BlogCategory');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, BlogCategory $blogcategory): bool
    {
        return $user->can('view BlogCategory');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create BlogCategory');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, BlogCategory $blogcategory): bool
    {
        return $user->can('update BlogCategory');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, BlogCategory $blogcategory): bool
    {
        return $user->can('delete BlogCategory');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, BlogCategory $blogcategory): bool
    {
        return $user->can('restore BlogCategory');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, BlogCategory $blogcategory): bool
    {
        return $user->can('force-delete BlogCategory');
    }
}
