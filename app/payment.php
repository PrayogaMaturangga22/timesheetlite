<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    protected $table = 'payment';

    protected $primaryKey = 'id';

    protected $fillable = [
        'token', 
        'payment_start',
        'payment_end',
        'trial_start',
        'trial_end',
        'feature_type',
        'payment_duration',
    ];
    
    protected $hidden = [
      'created_at', 
      'updated_at', 
    ];

    public function company()
    {
    	return $this->belongsTo('App\company', 'token', 'registered_token');
    }
}
