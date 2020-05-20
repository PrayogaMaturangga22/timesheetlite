<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class SubscriberSeeder extends Seeder
{
    public function run()
    {
    	DB::table('subscriber')->truncate();

    	$subscriber = [
	    	[
				'subscription_date'=>'2020-05-14', 
				'email'=>'anton@gmail.com', 
			],
	    	[
				'subscription_date'=>'2020-05-14', 
				'email'=>'mega@gmail.com', 
			],
	    	[
				'subscription_date'=>'2020-05-15', 
				'email'=>'budiman@gmail.com', 
			],
	    	[
				'subscription_date'=>'2020-05-16', 
				'email'=>'kartono@gmail.com', 
			],
	    	[
				'subscription_date'=>'2020-05-16', 
				'email'=>'cahyani@gmail.com', 
			],
		];
    	DB::table('subscriber')->insert($subscriber);
    }
}
