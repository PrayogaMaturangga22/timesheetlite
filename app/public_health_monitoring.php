<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class public_health_monitoring extends Model
{
    protected $table = 'public_health_monitoring';

    protected $primaryKey = 'id';

    protected $fillable = [
      'user_id', 
      'status', 
      'date',
    ];
    
    protected $hidden = [
		'created_at', 
		'updated_at', 
    ];

    public function users()
    {
    	return $this->hasOne('App\users', 'user_id', 'id');
	}
}
