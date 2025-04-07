<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Comment $comment): Response
    {
        return $user -> id === $comment->user_id
        ? Response::allow()
        : Response::deny('You can only update your comment');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Comment $comment): Response
    {
        return $user->id === $comment->user_id
        ? Response::allow()
        : Response::deny('You can only delete your comment');
    }
}