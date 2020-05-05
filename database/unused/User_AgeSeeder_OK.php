<?php

use Illuminate\Database\Seeder;

class User_AgeSeeder extends Seeder
{
    public function run()
    {
    	DB::table('User_Age')->truncate();

    	$User_Age = [
	    	[
				'age_number'=>'19', 
				'total'=>'2', 
				'color_code'=>'#4CAF50',
			],
	    	[
				'age_number'=>'20', 
				'total'=>'3', 
				'color_code'=>'#F44336',				
			],
	    	[
				'age_number'=>'22', 
				'total'=>'1', 
				'color_code'=>'#FFC107',
			],
	    	[
				'age_number'=>'24', 
				'total'=>'2', 
				'color_code'=>'#663399',
			],
     	];
    	DB::table('User_Age')->insert($User_Age);
    }
}
