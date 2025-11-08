<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;

class RoomReservation extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    public function reservedBy()
    {
        return $this->belongsTo(User::class, 'reserved_by', 'id'); 
    }

    public function rooms()
    {
       return $this->belongsTo(Room::class, 'room_name', 'name');  
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by', 'id'); 
    }

    public function disapprovedBy()
    {
        return $this->belongsTo(User::class, 'disapproved_by', 'id'); 
    }
}
