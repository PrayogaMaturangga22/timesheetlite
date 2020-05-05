<?php

use Illuminate\Database\Seeder;

class Expired_StatusSeeder extends Seeder
{
    public function run()
    {
    	DB::table('expired_status')->truncate();

    	$expired_status = [
	    	[
				'expired_status'=>'This Month', 
				'total'=>'10', 
				'color_code'=>'#FFC107',				
			],
	    	[
				'expired_status'=>'This Week', 
				'total'=>'2', 
				'color_code'=>'#F44336',
			],
     	];
    	DB::table('expired_status')->insert($expired_status);
    }
}
