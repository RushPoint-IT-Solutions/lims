<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;

class Cataloging extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'name',
        'framework_id',
        'type_id',
        'publisher',
        'isbn',
        'publication_year',
        'edition',
        'branch_id',
        'rack_id',
        'ddc',
        'description',
    ];

    public function authors()
    {
        return $this->hasMany(CatalogAuthor::class, 'catalog_id');
    }

    public function types()
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }

    public function branches()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function racks()
    {
        return $this->belongsTo(Rack::class, 'rack_id', 'id');
    }
}
