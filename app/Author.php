<?php

namespace App;

use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;

class Author extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id'); 
    }
}
