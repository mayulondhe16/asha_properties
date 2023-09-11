<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SubLayoutImages extends Model
{
    //
    use SoftDeletes;

    protected $table = 'sub_layout_images';
}
