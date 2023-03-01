<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

class TicketRepliesController extends Controller
{
    public function store(Ticket $ticket){
        $attributes = request()->validate([
            'reply' => ['required', 'min:5']
        ]);
        $ticket->replies()->create([
            'user_id' => request()->user()->id,
            'explanation' => $attributes['reply'],
            'attachments' => '',
        ]);

        return back()->with('dialogMessage', 'Your ticket reply has been created successfully!');
    }
}
