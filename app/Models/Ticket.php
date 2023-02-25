<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = [''];

    protected $with = ['product', 'category'];

    public static function findUserTickets(){
        return Ticket::where('user_id', auth()->user()->id);
    }

    public static function setPaginateToUserTickets(){
        return Ticket::findUserTickets()->paginate(8);
    }

    public static function findUserLastThreeTickets(){
        return Ticket::findUserTickets()->latest()->take(3)->get();
    }

    public static function findUserTicketsWithOpenStatus(){
        return Ticket::findUserTickets()->where('status', 1);
    }
    public static function findUserTicketsWithClosedStatus(){
        return Ticket::findUserTickets()->where('status', 0);
    }

    public static function userTicketsWithOpenStatusCount(){
        return Ticket::findUserTicketsWithOpenStatus()->count();
    }

    public static function userTicketsWithClosedStatusCount(){
        return Ticket::findUserTicketsWithClosedStatus()->count();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public  function category(){
        return $this->belongsTo(Category::class);
    }
}
