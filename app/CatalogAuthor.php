<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;

class CatalogAuthor extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = "catalog_authors";
    protected $fillable = ['catalog_id', 'author_name'];

    public function catalog()
    {
        return $this->belongsTo(Cataloging::class, 'catalog_id');
    }
}
