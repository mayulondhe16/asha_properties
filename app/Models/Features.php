<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Features extends Model
{
    //
    use SoftDeletes;

    protected $table = 'features';
}
