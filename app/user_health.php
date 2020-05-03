<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_health extends Model
{
    protected $table = 'user_health';

    protected $primaryKey = 'id';

    protected $fillable = [
      'health_status', 
      'total',
      'created_at', 
      'updated_at', 
      'color_code'
    ];
    
    protected $hidden = [
		'created_at', 
		'updated_at', 
    ];
}
