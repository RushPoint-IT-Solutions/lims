<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;

class Ebook extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
}
