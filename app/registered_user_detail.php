<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class registered_user_detail extends Model
{
  protected $table = 'registered_user_detail';

  protected $primaryKey = 'id';

  protected $fillable = [
    'date', 
    'total',
    'status', 
  ];
  
  protected $hidden = [
    'created_at', 
    'updated_at', 
  ];
}
