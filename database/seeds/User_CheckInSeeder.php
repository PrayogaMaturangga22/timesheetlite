<?php

use Illuminate\Database\Seeder;

class User_CheckInSeeder extends Seeder
{
    public function run()
    {
    	DB::table('User_CheckIn')->truncate();

    	$User_CheckIn = [
	    	[
				'checkin_status'=>'Check In', 
				'total'=>'6', 
				'color_code'=>'#4CAF50',
			],
	    	[
				'checkin_status'=>'Not Check In', 
				'total'=>'2', 
				'color_code'=>'#F44336',				
			],
	    	[
				'checkin_status'=>'Break', 
				'total'=>'0', 
				'color_code'=>'#CFE4F3',
			],
     	];
    	DB::table('User_CheckIn')->insert($User_CheckIn);
    }
}
