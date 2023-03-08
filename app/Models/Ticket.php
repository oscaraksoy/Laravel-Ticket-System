<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = [''];

    protected $with = ['product', 'category', 'status', 'priority'];

    public static function findTickets(){
        return Ticket::all();
    }

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
        return Ticket::findUserTickets()->where('status_id', 1);
    }
    public static function findUserTicketsWithClosedStatus(){
        return Ticket::findUserTickets()->where('status_id', 0);
    }

    public static function userTicketsWithOpenStatusCount(){
        return Ticket::findUserTicketsWithOpenStatus()->count();
    }

    public static function userTicketsWithClosedStatusCount(){
        return Ticket::findUserTicketsWithClosedStatus()->count();
    }

    public static function findTicketsWithOpenStatusCount(){
        return Ticket::findTickets()->where('status_id', 1)->count();
    }

    public static function findTicketsWithRepliedStatusCount(){
        return Ticket::findTickets()->where('status_id', 2)->count();
    }

    public static function findTicketsWithClosedStatusCount(){
        return Ticket::findTickets()->where('status_id', 0)->count();
    }

    public static function priorityWhereBuilderByPriortyId($priorityId){
        return Ticket::findTickets()
            ->where('priority_id', $priorityId)
            ->whereIn('status_id', [1, 2])
            ->count();
    }

    public static function findTicketsWithCriticalPriorityCount(){
        return self::priorityWhereBuilderByPriortyId(1);
    }

    public static function findTicketsWithHighPriorityCount(){
        return self::priorityWhereBuilderByPriortyId(2);
    }

    public static function findTicketsWithMediumPriorityCount(){
        return self::priorityWhereBuilderByPriortyId(3);
    }

    public static function findTicketsWithLowPriorityCount(){
        return self::priorityWhereBuilderByPriortyId(4);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function replies(){
        return $this->hasMany(TicketReply::class);
    }

    public function status(){
        return $this->belongsTo(StatusCode::class);
    }

    public function priority(){
        return $this->belongsTo(TicketPriority::class);
    }
}
