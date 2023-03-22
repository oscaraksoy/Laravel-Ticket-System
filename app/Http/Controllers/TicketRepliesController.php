<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Ticket;
use App\Models\TicketReply;

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

        if(request()->user()->can('staff')){
            $ticket->update([
                'status_id' => 2
            ]);

            Message::create([
                'user_id' => $ticket->user->id,
                'explanation' => 'Support request #'.$ticket->id.' has been answered!',
                'link_to' => '/tickets/ticket/'.$ticket->id,
                'is_read' => 0
            ]);
        }

        return back()->with('dialogMessage', 'Your ticket reply has been created successfully!');
    }

    public function destroy(Ticket $ticket, TicketReply $reply){
        TicketReply::where('id', '=', $reply->id, 'and', 'ticket_id', '=', $ticket->id)->delete();
        return back()->with('dialogMessage', 'Your reply has been deleted successfully!');
    }
}
