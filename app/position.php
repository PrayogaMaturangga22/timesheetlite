<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class position extends Model
{
    protected $table = 'position';

    protected $primaryKey = 'id';

    protected $fillable = [
		'position_name', 
		'created_at', 
		'updated_at', 
    ];
    
    protected $hidden = [
		'created_at', 
		'updated_at', 
    ];

    public function staff()
    {
    	return $this->hasOne('App\staff', 'position_id', 'id');
    }
}
