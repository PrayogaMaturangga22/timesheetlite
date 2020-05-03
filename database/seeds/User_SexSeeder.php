<?php

use Illuminate\Database\Seeder;

class User_SexSeeder extends Seeder
{
    public function run()
    {
    	DB::table('User_Sex')->truncate();

    	$User_Sex = [
	    	[
				'sex'=>'Male', 
				'total'=>'5', 
				'color_code'=>'#4CAF50',
			],
	    	[
				'sex'=>'Female', 
				'total'=>'3', 
				'color_code'=>'#663399',
			],
     	];
    	DB::table('User_Sex')->insert($User_Sex);
    }
}
