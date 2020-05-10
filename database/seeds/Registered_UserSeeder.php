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
				'date'=>'2020-04-20', 
				'total'=>'22',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
	    	[
				'date'=>'2020-04-21', 
				'total'=>'10',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
			],
	    	[
				'date'=>'2020-04-22', 
				'total'=>'37',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
			],
	    	[
				'date'=>'2020-04-23', 
				'total'=>'45',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
			],
	    	[
				'date'=>'2020-04-24', 
				'total'=>'9',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
			],
	    	[
				'date'=>'2020-04-25', 
				'total'=>'29',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
			],
	    	[
				'date'=>'2020-04-26', 
				'total'=>'16',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
			],
	    	[
				'date'=>'2020-04-27', 
				'total'=>'8',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
			],
	    	[
				'date'=>'2020-04-28', 
				'total'=>'7',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
			],
	    	[
				'date'=>'2020-04-29', 
				'total'=>'20',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
			],
	    	[
				'date'=>'2020-04-30', 
				'total'=>'31',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
			],
     	];
    	DB::table('Registered_User')->insert($Registered_User);
    }
}
