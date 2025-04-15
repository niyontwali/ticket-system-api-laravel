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



// class CommentPolicy
// {
//     /**
//      * Determine whether the user can update the model.
//      */
//     public function update(User $user, Comment $comment): Response
//     {
//         // Check if the user is an admin or if the user is the owner of the comment
//         return $user->role === 'admin' || $user->id === $comment->user_id
//             ? Response::allow()  // If the user is an admin or the owner, allow the action
//             : Response::deny('You can only update your comment or if you are an admin');  // Deny with a message if the user is neither
//     }

//     /**
//      * Determine whether the user can delete the model.
//      */
//     public function delete(User $user, Comment $comment): Response
//     {
//         // Check if the user is an admin or if the user is the owner of the comment
//         return $user->role === 'admin' || $user->id === $comment->user_id
//             ? Response::allow()  // If the user is an admin or the owner, allow the action
//             : Response::deny('You can only delete your comment or if you are an admin');  // Deny with a message if the user is neither
//     }
// }
