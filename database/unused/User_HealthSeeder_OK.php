<?php

use Illuminate\Database\Seeder;

class User_HealthSeeder extends Seeder
{
    public function run()
    {
    	DB::table('User_Health')->truncate();

    	$User_Health = [
	    	[
				'health_status'=>'Normal', 
				'total'=>'5', 
				'color_code'=>'#4CAF50',
			],
	    	[
				'health_status'=>'PDP', 
				'total'=>'2', 
				'color_code'=>'#F44336',				
			],
	    	[
				'health_status'=>'Positif', 
				'total'=>'1', 
				'color_code'=>'#FFC107',
			],
     	];
    	DB::table('User_Health')->insert($User_Health);
    }
}
