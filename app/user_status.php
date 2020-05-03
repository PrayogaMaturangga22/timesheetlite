<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_status extends Model
{
    protected $table = 'user_status';

    protected $primaryKey = 'id';

    protected $fillable = [
      'user_status', 
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
