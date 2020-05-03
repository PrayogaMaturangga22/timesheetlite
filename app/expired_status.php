<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class expired_status extends Model
{
    protected $table = 'expired_status';

    protected $primaryKey = 'id';

    protected $fillable = [
      'expired_status', 
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
