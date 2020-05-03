<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_checkin extends Model
{
    protected $table = 'user_checkin';

    protected $primaryKey = 'id';

    protected $fillable = [
      'checkin_status', 
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
