<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;

class Rack extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id'); 
    }
}
