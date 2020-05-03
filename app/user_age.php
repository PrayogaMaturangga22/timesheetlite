<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_age extends Model
{
    protected $table = 'user_age';

    protected $primaryKey = 'id';

    protected $fillable = [
      'age_number', 
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
