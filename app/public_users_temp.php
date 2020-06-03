<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class public_users_temp extends Model
{
    protected $table = 'public_users_temp';

    protected $primaryKey = 'id';

    protected $fillable = [
      'username', 
      'email', 
      'password', 
      'token', 
      'expired_at',
      'sent_at',
      'created_at', 
      'updated_at', 
    ];
    
    protected $hidden = [
      'created_at', 
      'updated_at', 
    ];
}
