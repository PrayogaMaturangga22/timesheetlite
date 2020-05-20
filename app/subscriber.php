<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subscriber extends Model
{
    protected $table = 'subscriber';

    protected $primaryKey = 'id';

    protected $fillable = [
		'subscription_date', 
		'email', 
    ];
    
    protected $hidden = [
		'created_at', 
		'updated_at', 
    ];
}
