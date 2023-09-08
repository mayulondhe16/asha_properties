<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Amenities extends Model
{
    //
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
