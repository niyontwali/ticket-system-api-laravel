<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $comments = Comment::with(['user', 'ticket'])->latest()->get();
        return response()->json([
            'ok' => true,
            'data' => $comments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $fields = $request->validate([
            'message' => 'required|string|max:1000',
            'ticket_id' => 'required|exists:tickets,id',
        ]);

        $comment = Comment::create([
            'message' => $fields['message'],
            'ticket_id' => $fields['ticket_id'],
            'user_id' => Auth::id(),
        ]);

        return response()->json([
            'ok' => true,
            'message' => 'Comment created successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        $comment->load(['user', 'ticket']);
        return response()->json([
            'ok' => true,
            'data' => $comment
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        Gate::authorize('update', $comment);

        $fields = $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $comment->update([
            'message' => $fields['message'],
        ]);

        return response()->json([
            'ok' => true,
            'message' => 'Comment updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment): JsonResponse
    {
        Gate::authorize('delete', $comment);

        
        $comment->delete();

        return response()->json([
            'ok' => true,
            'message' => 'Comment deleted successfully'
        ]);
    }
}