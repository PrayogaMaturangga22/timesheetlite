<?php

use Illuminate\Database\Seeder;

class Registered_User_DetailSeeder extends Seeder
{
    public function run()
    {
    	DB::table('Registered_User_detail')->truncate();

    	$Registered_User_detail = [
	    	[
				'date'=>'2020-04-01', 
				'total'=>'2', 
				'status'=>'Premium', 
			],
	    	[
				'date'=>'2020-04-01', 
				'total'=>'1', 
				'status'=>'Free', 
			],
	    	[
				'date'=>'2020-04-01', 
				'total'=>'3', 
				'status'=>'Trial', 
			],
	    	[
				'date'=>'2020-05-01', 
				'total'=>'5', 
				'status'=>'Premium', 
			],
	    	[
				'date'=>'2020-05-01', 
				'total'=>'3', 
				'status'=>'Free', 
			],
	    	[
				'date'=>'2020-06-01', 
				'total'=>'0', 
				'status'=>'Trial', 
			],
     	];
    	DB::table('Registered_User_detail')->insert($Registered_User_detail);
    }
}
