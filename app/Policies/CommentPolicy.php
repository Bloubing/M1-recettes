<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function edit(User $user, Comment $comment)
    {
        //Owner ou mod ou admin
        return $comment->user->is($user) || $user->isModerator();
    }

    public function update(User $user, Comment $comment): bool
    {
        //Owner ou mod ou admin
        return $comment->user->is($user) || $user->isModerator();
    }

    public function delete(User $user, Comment $comment)
    {
        //Owner or Admin
        return ($comment->user->is($user)) || $user->isAdmin();
    }
}
