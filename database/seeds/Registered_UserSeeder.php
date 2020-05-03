<?php

use Illuminate\Database\Seeder;

class Registered_UserSeeder extends Seeder
{
    public function run()
    {
    	DB::table('Registered_User')->truncate();

    	$Registered_User = [
	    	[
				'date'=>'2020-04-20', 
				'total'=>'22', 
			],
	    	[
				'date'=>'2020-04-21', 
				'total'=>'10', 
			],
	    	[
				'date'=>'2020-04-22', 
				'total'=>'37', 
			],
	    	[
				'date'=>'2020-04-23', 
				'total'=>'45', 
			],
	    	[
				'date'=>'2020-04-24', 
				'total'=>'9', 
			],
	    	[
				'date'=>'2020-04-25', 
				'total'=>'29', 
			],
	    	[
				'date'=>'2020-04-26', 
				'total'=>'16', 
			],
	    	[
				'date'=>'2020-04-27', 
				'total'=>'8', 
			],
	    	[
				'date'=>'2020-04-28', 
				'total'=>'7', 
			],
	    	[
				'date'=>'2020-04-29', 
				'total'=>'20', 
			],
	    	[
				'date'=>'2020-04-30', 
				'total'=>'31', 
			],
     	];
    	DB::table('Registered_User')->insert($Registered_User);
    }
}
