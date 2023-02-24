<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public static function findUserLastThreeTickets(){
        $tickets = Ticket::all()->take(-3);

        return $tickets;
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
