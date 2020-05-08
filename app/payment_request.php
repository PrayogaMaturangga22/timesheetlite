<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payment_request extends Model
{
    protected $table = 'payment_request';

    protected $primaryKey = 'id';

    protected $fillable = [
        'company_id', 
        'pricing',
        'duration',
        'sub_total',
        'discount',
        'grand_total',
        'status',      
    ];
    
    protected $hidden = [
		'created_at', 
		'updated_at', 
    ];

    public function company()
    {
    	return $this->belongsTo('App\company', 'company_id', 'id');
    }
}
