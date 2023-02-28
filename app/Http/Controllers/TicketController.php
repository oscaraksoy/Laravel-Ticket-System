<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Ticket;
use App\Models\TicketReply;

class TicketController extends Controller
{
    public function index(){
        return view('ticket.index', [
            'tickets' => Ticket::setPaginateToUserTickets(),
        ]);
    }

    public function show(Ticket $ticket){
        return view('ticket.show', [
            'ticket' => $ticket,
            'replies' => TicketReply::findTicketReplies($ticket)
        ]);
    }

    public function create(){
        return view('ticket.create', [
            'categories' => Category::all(),
            'products' => Product::all(),
        ]);
    }

    public function store(){
        $attributes = request()->validate([
            'title' => ['required', 'min:10', 'max:255'],
            'product' => ['required'],
            'category' => ['required'],
            'explanation'=> ['min:20', 'max:800']
        ]);

        Ticket::create([
            'user_id' => auth()->user()->id,
            'product_id' => $attributes['product'],
            'category_id' => $attributes['category'],
            'title' => $attributes['title'],
            'explanation' => $attributes['explanation'],
            'status' => 1,
            'attachments' => '',
        ]);

        return back()->with('dialogMessage', 'Your ticket has been created successfully!');
    }
}
