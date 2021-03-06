<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    protected $table = 'public_users';

    protected $primaryKey = 'id';

    protected $fillable = [
		'username', 
		'email', 
		'password', 
		'pin', 
		'imei', 
		'device_name', 
		'user_status',
		'created_at',
		'updated_at'
    ];
    
    protected $hidden = [
		'remember_token', 
		'created_at', 
		'updated_at', 
    ];

    public function staff()
    {
    	return $this->hasOne('App\staff', 'user_id', 'id');
	}
}
