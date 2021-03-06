<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class UsersSeeder extends Seeder
{
    public function run()
    {
    	DB::table('public_users')->truncate();

    	$users = [
	    	[
				'username'=>'majusuksessejahtera1', 
				'email'=>'majusuksessejahtera1@gmail.com', 
				'password'=> bcrypt('1'), 
				'pin'=>'2204545', 
				'imei'=>'03489374537549753', 
				'device_name'=>'Samsung Galaxy 9', 
				'user_status'=>'1',
				'is_admin'=>'1',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
	    	[
				'username'=>'majusuksessejahtera2', 
				'email'=>'majusuksessejahtera2@gmail.com', 
				'password'=> bcrypt('1'), 
				'pin'=>'234234', 
				'imei'=>'67867867867867867', 
				'device_name'=>'Samsung Galaxy 10', 
				'user_status'=>'1',
				'is_admin'=>'0',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
	    	[
				'username'=>'majusuksessejahtera3', 
				'email'=>'majusuksessejahtera3@gmail.com', 
				'password'=> bcrypt('1'), 
				'pin'=>'5675675', 
				'imei'=>'34865783485345345', 
				'device_name'=>'iPhone 5s', 
				'user_status'=>'1',
				'is_admin'=>'0',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
			],
	    	[
				'username'=>'megahkaryasurya1', 
				'email'=>'megahkaryasurya1@gmail.com', 
				'password'=> bcrypt('1'), 
				'pin'=>'6567567', 
				'imei'=>'984375973458793745', 
				'device_name'=>'iPhone 5s', 
				'user_status'=>'1',
				'is_admin'=>'1',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
	    	[
				'username'=>'megahkaryasurya2', 
				'email'=>'megahkaryasurya2@gmail.com', 
				'password'=> bcrypt('1'), 
				'pin'=>'082493', 
				'imei'=>'021268348573547357', 
				'device_name'=>'iPhone 5 SE', 
				'user_status'=>'0',
				'is_admin'=>'0',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
	    	[
				'username'=>'amanjayakeramik1', 
				'email'=>'amanjayakeramik1@gmail.com', 
				'password'=> bcrypt('1'), 
				'pin'=>'4343434', 
				'imei'=>'3485983749579374857', 
				'device_name'=>'iPhone 5 SE', 
				'user_status'=>'1',
				'is_admin'=>'1',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
	    	[
				'username'=>'amanjayakeramik2', 
				'email'=>'amanjayakeramik2@gmail.com', 
				'password'=> bcrypt('1'), 
				'pin'=>'123122', 
				'imei'=>'3485983749579348561', 
				'device_name'=>'iPhone 5 SE', 
				'user_status'=>'1',
				'is_admin'=>'0',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
	    	[
				'username'=>'amanjayakeramik3', 
				'email'=>'amanjayakeramik3@gmail.com', 
				'password'=> bcrypt('1'), 
				'pin'=>'8745676', 
				'imei'=>'6563465375635735463', 
				'device_name'=>'iPhone 5 SE', 
				'user_status'=>'0',
				'is_admin'=>'0',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],

     	];
    	DB::table('public_users')->insert($users);
    }
}
