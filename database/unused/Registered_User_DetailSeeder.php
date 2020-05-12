<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class Registered_User_DetailSeeder extends Seeder
{
    public function run()
    {
    	DB::table('Registered_User_detail')->truncate();

    	$Registered_User_detail = [
	    	[
				'date'=>'2020-05-01', 
				'total'=>'5', 
				'status'=>'Premium',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
			],
	    	[
				'date'=>'2020-05-01', 
				'total'=>'3', 
				'status'=>'Free',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
			],
	    	[
				'date'=>'2020-06-01', 
				'total'=>'0', 
				'status'=>'Trial',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
			],
     	];
    	DB::table('Registered_User_detail')->insert($Registered_User_detail);
    }
}
