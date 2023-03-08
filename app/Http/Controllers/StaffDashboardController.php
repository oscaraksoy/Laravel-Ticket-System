<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class StaffDashboardController extends Controller
{
    public function create(){
        return view('staff.create', [
            'ticketsWithOpenStatusCount' => Ticket::findTicketsWithOpenStatusCount(),
            'ticketsWithRepliedStatusCount' => Ticket::findTicketsWithRepliedStatusCount(),
            'ticketsWithClosedStatusCount' => Ticket::findTicketsWithClosedStatusCount(),
            'ticketsWithCriticalPriorityCount' => Ticket::findTicketsWithCriticalPriorityCount(),
            'ticketsWithHighPriorityCount' => Ticket::findTicketsWithHighPriorityCount(),
            'ticketsWithMediumPriorityCount' => Ticket::findTicketsWithMediumPriorityCount(),
            'ticketsWithLowPriorityCount' => Ticket::findTicketsWithLowPriorityCount(),
        ]);
    }
}
