<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Models\Branch;
use App\Models\Church;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of messages.
     */
    public function index()
    {
        $messages = Message::with(['sender', 'receiver', 'church', 'branch'])->get();
        return view('messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new message.
     */
    public function create()
    {
        $users = User::all();
        $churches = Church::all();
        $branches = Branch::all();
        return view('messages.create', compact('users', 'churches', 'branches'));
    }

    /**
     * Store a newly created message in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sender_id' => 'required|exists:users,id',
            'receiver_id' => 'required|exists:users,id',
            'type' => 'required|string',
            'body' => 'required|string',
            'church_id' => 'required|exists:churches,id',
            'branch_id' => 'nullable|exists:branches,id',
            'status' => 'required|in:sent,delivered,read',
        ]);

        Message::create($request->all());
        return redirect()->route('messages')->with('success', 'Message sent successfully.');
    }

    /**
     * Show the specified message.
     */
    public function show(Message $message)
    {
        return view('messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified message.
     */
    public function edit(Message $message)
    {
        $users = User::all();
        $churches = Church::all();
        $branches = Branch::all();
        return view('messages.edit', compact('message', 'users', 'churches', 'branches'));
    }

    /**
     * Update the specified message in storage.
     */
    public function update(Request $request, Message $message)
    {
        $request->validate([
            'sender_id' => 'required|exists:users,id',
            'receiver_id' => 'required|exists:users,id',
            'type' => 'required|string',
            'body' => 'required|string',
            'church_id' => 'required|exists:churches,id',
            'branch_id' => 'nullable|exists:branches,id',
            'status' => 'required|in:sent,delivered,read',
        ]);

        $message->update($request->all());
        return redirect()->route('messages')->with('success', 'Message updated successfully.');
    }

    /**
     * Remove the specified message from storage.
     */
    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('messages')->with('success', 'Message deleted successfully.');
    }
}
