<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class request_demo extends Model
{
    protected $table = 'request_demo';

    protected $primaryKey = 'id';

    protected $fillable = [
		'request_date', 
		'name', 
		'company_name', 
		'phone_number', 
		'email', 
		'message', 
		'created_at', 
		'updated_at', 
    ];
    
    protected $hidden = [
		'created_at', 
		'updated_at', 
    ];
}
