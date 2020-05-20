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
				'first_name'=>'Users', 
				'last_name'=>'Message 1', 
				'email'=>'usersmessage1@gmail.com', 
				'title'=>'Aplikasi Mantap ini', 
				'message'=>'Aplikasi kamu sangat mantap saya suka', 
			],
	    	[
				'contact_date'=>'2020-05-15', 
				'first_name'=>'Users', 
				'last_name'=>'Message 2', 
				'email'=>'usersmessage2@gmail.com', 
				'title'=>'Aplikasi Saya Sangat Rekomendasi', 
				'message'=>'Saya akan merekomendasikan aplikasi Anda', 
			],
		];
    	DB::table('contact')->insert($contact);
    }
}
