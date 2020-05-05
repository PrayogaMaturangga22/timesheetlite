<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_sex extends Model
{
    protected $table = 'user_sex';

    protected $primaryKey = 'id';

    protected $fillable = [
      'sex', 
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
