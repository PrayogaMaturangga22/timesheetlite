<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class ContactSeeder extends Seeder
{
    public function run()
    {
    	DB::table('contact')->truncate();

    	$contact = [
	    	[
				'contact_date'=>'2020-05-18', 
				'name'=>'Users Message 1', 
				'email'=>'usersmessage1@gmail.com', 
				'phone_number'=>'9384593458943', 
				'message'=>'Aplikasi kamu sangat mantap saya suka', 
			],
	    	[
				'contact_date'=>'2020-05-15', 
				'name'=>'Users Message 2', 
				'email'=>'usersmessage2@gmail.com', 
				'phone_number'=>'9384593458943', 
				'message'=>'Saya akan merekomendasikan aplikasi Anda', 
			],
		];
    	DB::table('contact')->insert($contact);
    }
}
