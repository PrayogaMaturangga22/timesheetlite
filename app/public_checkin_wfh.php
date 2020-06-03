<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class public_checkin_wfh extends Model
{
    protected $table = 'public_checkin_wfh';

    protected $primaryKey = 'id';

    protected $fillable = [
		'user_id', 
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
