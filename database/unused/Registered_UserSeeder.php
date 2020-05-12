<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class Registered_UserSeeder extends Seeder
{
    public function run()
    {
    	DB::table('Registered_User')->truncate();

    	$Registered_User = [
	    	[
				'date'=>'2020-05-10', 
				'total'=>'1',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
     	];
    	DB::table('Registered_User')->insert($Registered_User);
    }
}
