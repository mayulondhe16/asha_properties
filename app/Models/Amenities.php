<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Amenities extends Model
{
    use SoftDeletes;

    protected $table = 'aminity';
    protected $fillable = [
    	'id',
		'project_id',		
        'aminity',		
        'image',		
        'created_at',		
        'updated_at',		
        'amenityicon',		
        'status',		
        'deleted_at',		
    ];
}
