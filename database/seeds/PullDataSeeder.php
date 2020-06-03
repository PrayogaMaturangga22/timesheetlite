<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class PullDataSeeder extends Seeder
{
    public function run()
    {
    	DB::table('pulldata')->truncate();

    	$pulldata = [
	    	[
                'table_name'=>'company',
                'last_pull_date'=>'2020-05-08 22:20:30.000',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
	    	[
				'table_name'=>'users_temp', 
				'last_pull_date'=>'2020-05-05 16:20:30.000',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
	    	[
				'table_name'=>'users', 
				'last_pull_date'=>'2020-05-05 16:20:30.000',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
	    	[
				'table_name'=>'staff', 
				'last_pull_date'=>'2020-05-05 16:20:30.000',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
			[
				'table_name'=>'checkin_wfh', 
				'last_pull_date'=>'2020-05-05 16:20:30.000',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
	    	[
				'table_name'=>'health_monitoring', 
				'last_pull_date'=>'2020-05-05 16:20:30.000',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
     	];
    	DB::table('pulldata')->insert($pulldata);
    }
}
