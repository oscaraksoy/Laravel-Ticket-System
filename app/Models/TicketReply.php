<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketReply extends Model
{
    use HasFactory;

    protected $with = ['user', 'ticket'];

    protected $fillable = ['user_id', 'explanation', 'attachments'];

    public static function findTicketReplies($ticket){
        return TicketReply::all()->where('ticket_id', $ticket->id);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function ticket(){
        return $this->belongsTo(Ticket::class);
    }
}
