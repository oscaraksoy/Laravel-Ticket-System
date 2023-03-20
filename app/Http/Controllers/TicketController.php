<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Message;
use App\Models\Product;
use App\Models\StatusCode;
use App\Models\Ticket;
use App\Models\TicketPriority;
use App\Models\TicketReply;

class TicketController extends Controller
{
    public function index(){
        return view('ticket.index', [
            'tickets' => Ticket::setPaginateToUserTickets(),
        ]);
    }

    public function show(Ticket $ticket){
        if(request()->has('notificationId')){
            $notificationId = request('notificationId');
            Message::setReadMessage($notificationId);
        }

        return view('ticket.show', [
            'ticket' => $ticket,
            'replies' => TicketReply::findTicketReplies($ticket),
            'priorities' => TicketPriority::all(),
            'statuses' => StatusCode::all()
        ]);
    }

    public function create(){
        return view('ticket.create', [
            'categories' => Category::all(),
            'parentCategories' => Product::groupByProductCategory(),
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
            'status_id' => 1,
            'priority_id' => 4,
            'attachments' => '',
        ]);

        return back()->with('dialogMessage', 'Your ticket has been created successfully!');
    }
}
