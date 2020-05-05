<?php

use Illuminate\Database\Seeder;

class User_StatusSeeder extends Seeder
{
    public function run()
    {
    	DB::table('user_status')->truncate();

    	$user_status = [
	    	[
				'user_status'=>'Active', 
                'total'=>'20', 
				'color_code'=>'#4CAF50',
			],
	    	[
				'user_status'=>'Inactive', 
				'total'=>'3', 
				'color_code'=>'#663399',
			],
     	];
    	DB::table('user_status')->insert($user_status);
    }
}
