<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pulldata extends Model
{
    protected $table = 'pulldata';

    protected $primaryKey = 'id';

    protected $fillable = [
		'table_name', 
		'table_pull_date', 
		'created_at', 
		'updated_at', 
    ];
    
    protected $hidden = [
		'created_at', 
		'updated_at', 
    ];
}
