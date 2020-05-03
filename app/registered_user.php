<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class registered_user extends Model
{
    protected $table = 'registered_user';

    protected $primaryKey = 'id';

    protected $fillable = [
      'date', 
      'total',
      'created_at', 
      'updated_at', 
    ];
    
    protected $hidden = [
		'created_at', 
		'updated_at', 
    ];
}
