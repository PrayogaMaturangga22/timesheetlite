<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class LoginSeeder extends Seeder
{
    public function run()
    {
    	DB::table('users')->truncate();

    	$users = [
	    	[
				'name'=>'Administrator', 
				'email'=>'administrator@gmail.com', 
				'access_type'=>'Admin', 
				'password'=> bcrypt('1'), 
			],
	    	[
				'name'=>'Operator', 
				'email'=>'operator@gmail.com', 
				'access_type'=>'Operator', 
				'password'=> bcrypt('1'), 
			]
		];
    	DB::table('users')->insert($users);
    }
}
