<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class summarized_table extends Model
{
    protected $table = 'summarized_table';

    protected $primaryKey = 'id';

    protected $fillable = [
      'column_name', 
      'total', 
      'column_desc', 
    ];
    
    protected $hidden = [
		'remember_token', 
		'created_at', 
		'updated_at', 
    ];
}
