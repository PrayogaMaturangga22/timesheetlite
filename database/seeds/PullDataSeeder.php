<?php

use Illuminate\Database\Seeder;

class PullDataSeeder extends Seeder
{
    public function run()
    {
    	DB::table('pulldata')->truncate();

    	$pulldata = [
	    	[
                'table_name'=>'company', 
                'last_pull_date'=>'2020-05-08 22:20:30.000'
			],
	    	[
				'table_name'=>'users', 
                'last_pull_date'=>'2020-05-05 16:20:30.000'
			],
     	];
    	DB::table('pulldata')->insert($pulldata);
    }
}
