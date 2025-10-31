<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id'); 
    }
}
