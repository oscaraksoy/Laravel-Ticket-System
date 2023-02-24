<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

class HomeController extends Controller
{
    public static function create(){
        return view('home.create', [
            'tickets' => Ticket::findUserLastThreeTickets(),
        ]);
    }
}
