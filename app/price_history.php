<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class price_history extends Model
{
    protected $table = 'price_history';

    protected $primaryKey = 'id';

    protected $fillable = [
      'change_date', 
      'from_price', 
      'to_price', 
      'created_at', 
      'updated_at', 
    ];
    
    protected $hidden = [
      'created_at', 
      'updated_at', 
    ];
}
