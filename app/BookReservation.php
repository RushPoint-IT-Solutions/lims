<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;

class BookReservation extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'reservation_id',
        'book_id',
        'reserved_by',
        'reserved_date',
        'status',
        'pickup_date'
    ];
    
    public function authors()
    {
        return $this->hasMany(CatalogAuthor::class, 'catalog_id');
    }

    public function books()
    {
        return $this->belongsTo(Cataloging::class, 'book_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'reserved_by', 'id');
    }

}
