<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    protected $table = 'public_company';

    protected $primaryKey = 'id';

    protected $fillable = [
		'kode_perusahaan', 
		'company_name', 
		'address', 
		'contact', 
		'website', 
		'password', 
		'member_counter', 
		'registered_token',
		'app_status',
		'trial_kuota',
		'created_at', 
		'updated_at', 
    ];
    
    protected $hidden = [
		'created_at', 
		'updated_at', 
    ];

    public function staff()
    {
    	return $this->hasOne('App\staff', 'company_id', 'id');
    }
}
