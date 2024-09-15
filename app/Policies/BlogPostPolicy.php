<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\BlogPost;
use App\Models\User;

class BlogPostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any BlogPost');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, BlogPost $blogpost): bool
    {
        return $user->can('view BlogPost');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create BlogPost');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, BlogPost $blogpost): bool
    {
        return $user->can('update BlogPost');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, BlogPost $blogpost): bool
    {
        return $user->can('delete BlogPost');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, BlogPost $blogpost): bool
    {
        return $user->can('restore BlogPost');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, BlogPost $blogpost): bool
    {
        return $user->can('force-delete BlogPost');
    }
}
