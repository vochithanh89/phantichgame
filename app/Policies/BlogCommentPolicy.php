<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\BlogComment;
use App\Models\User;

class BlogCommentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any BlogComment');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, BlogComment $blogcomment): bool
    {
        return $user->can('view BlogComment');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create BlogComment');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, BlogComment $blogcomment): bool
    {
        return $user->can('update BlogComment');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, BlogComment $blogcomment): bool
    {
        return $user->can('delete BlogComment');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, BlogComment $blogcomment): bool
    {
        return $user->can('restore BlogComment');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, BlogComment $blogcomment): bool
    {
        return $user->can('force-delete BlogComment');
    }
}
