<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminTicketsController extends Controller
{
    public function create(){
        return view('panel.tickets.create');
    }
}
