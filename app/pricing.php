<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pricing extends Model
{
    protected $table = 'pricing';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
  		'pricing', 
    ];
}
