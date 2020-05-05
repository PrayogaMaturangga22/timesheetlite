<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subscription_status extends Model
{
  protected $table = 'subscription_status';

  protected $primaryKey = 'id';

  protected $fillable = [
    'name', 
    'color_code', 
  ];
  
  protected $hidden = [
    'created_at', 
    'updated_at', 
  ];
}
