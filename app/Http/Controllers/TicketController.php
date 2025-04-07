<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display all tickets with relationships.
     */
    public function index()
    {
        $tickets = Ticket::with(['user', 'assignedUser', 'comments'])->get();
        return response() -> json([
            'ok' => true,
            'data'=> $tickets
        ]);
    }

    /**
     * Store a new ticket.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'user_id'=>'required|exists:users,id',
            'status' => 'nullable|in:open,in_progress,resolved',
            'priority' => 'nullable|in:low,medium,high,critical',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $validated['user_id'] = Auth::id();
        Ticket::create($fields);
        
        return response()->json([
            'ok' => true,
            'message' => 'Ticket created successfully'
        ]);
    }

    /**
     * Display a specific ticket.
     */
    public function show(Ticket $ticket)
    {
        $ticket->load(['user', 'assignedUser', 'comments.user']);
        return response() -> json([
            'ok' => true,
            'data'=> $ticket
        ]);
    }

    /**
     * Update a ticket.
     */
    public function update(Request $request, Ticket $ticket)
    {
        $fields = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'status' => 'sometimes|required|in:open,in_progress,resolved',
            'priority' => 'sometimes|required|in:low,medium,high,critical',
            'assigned_to' => 'sometimes|nullable|exists:users,id',
        ]);

        $ticket->update($fields);
        return response()->json([
            'ok' => true,
            'message' => 'Ticket updated successfully'
        ]);
    }

    /**
     * Delete a ticket.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return response()->json([
            'ok' => true,
            'message' => 'Ticket deleted successfully'
        ]);
    }
}
