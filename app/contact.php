<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    protected $table = 'contact';

    protected $primaryKey = 'id';

    protected $fillable = [
		'contact_date', 
		'name', 
		'email', 
		'phone_number', 
		'message', 
		'created_at', 
		'updated_at', 
    ];
    
    protected $hidden = [
		'created_at', 
		'updated_at', 
    ];
}
