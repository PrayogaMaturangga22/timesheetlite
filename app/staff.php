<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class staff extends Model
{
    protected $table = 'public_staff';

    protected $primaryKey = 'id';

    protected $fillable = [
		'user_id', 
		'company_id', 
		'position', 
		'superior_id', 
		'full_name', 
		'gender', 
		'address',
		'phone_number',
		'date_of_birth',
		'image_profile',
		'health_condition',
		'wfh_status',
		'total_task',
		'total_task_done',
		'created_at', 
		'updated_at', 
    ];
    
    protected $hidden = [
		'created_at', 
		'updated_at', 
    ];

    public function user()
    {
    	return $this->belongsTo('App\users', 'user_id', 'id');
    }

    public function superior()
    {
    	return $this->belongsTo('App\staff', 'superior_id', 'id');
    }

    public function company()
    {
    	return $this->belongsTo('App\company', 'company_id', 'id');
    }
}
