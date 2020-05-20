<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class Request_DemoSeeder extends Seeder
{
    public function run()
    {
    	DB::table('request_demo')->truncate();

    	$request_demo = [
	    	[
				'request_date'=>'2020-05-14', 
				'name'=>'Anton Kriminilis', 
				'company_name'=>'Mantap Company', 
				'phone_number'=>'634673475678345', 
				'email'=>'usersmantap1@gmail.com', 
				'message'=>'-', 
			],
	    	[
				'request_date'=>'2020-05-14', 
				'name'=>'Budi Budiman', 
				'company_name'=>'Mantap Warbiasa', 
				'phone_number'=>'485893458345345', 
				'email'=>'usersmantap3@gmail.com', 
				'message'=>'-', 
			],
	    	[
				'request_date'=>'2020-05-14', 
				'name'=>'Budi Dharmawan', 
				'company_name'=>'Mantap Usaha', 
				'phone_number'=>'0328402903423', 
				'email'=>'usersmantap2@gmail.com', 
				'message'=>'-', 
			]
		];
    	DB::table('request_demo')->insert($request_demo);
    }
}
