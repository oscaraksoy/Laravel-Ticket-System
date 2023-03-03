<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Ticket;

class HomeController extends Controller
{
    public static function create(){
        return view('home.create', [
            'tickets' => Ticket::findUserLastThreeTickets(),
            'openTicketsCount' => Ticket::userTicketsWithOpenStatusCount(),
            'closedTicketsCount' => Ticket::userTicketsWithClosedStatusCount(),
            'messages' => Message::findUserMessagesPaginated(),
            'unreadMessagesCount' => Message::getTotalUnreadMessages()
        ]);
    }
}
