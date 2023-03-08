<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class StaffTicketsController extends Controller
{
    public function create(){
        return view('staff.tickets.create', [
            'tickets' => Ticket::all()
        ]);
    }

    public function update(Ticket $ticket){
        $attributes = request()->validate([
            'priority' => ['required'],
            'status' => ['required'],
        ]);

        $ticket->update([
            'priority_id' => $attributes['priority'],
            'status_id' => $attributes['status'],
        ]);

        return redirect('/tickets/ticket/'.$ticket->id)->with('dialogMessage', 'Ticket has been updated.');
    }
}
