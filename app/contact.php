<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    protected $table = 'contact';

    protected $primaryKey = 'id';

    protected $fillable = [
		'contact_date', 
		'first_name', 
		'last_name', 
		'email', 
		'title', 
		'message', 
		'created_at', 
		'updated_at', 
    ];
    
    protected $hidden = [
		'created_at', 
		'updated_at', 
    ];
}
