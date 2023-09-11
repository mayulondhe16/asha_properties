<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProjectImages extends Model
{
    //
    use SoftDeletes;

    protected $table = 'project_images';
}
