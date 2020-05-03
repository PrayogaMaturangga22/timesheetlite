<?php

use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    public function run()
    {
    	DB::table('position')->truncate();

    	$position = [
	    	[
				'position_name'=>'Ketua', 
			],
	    	[
				'position_name'=>'CEO', 
			],
            [
				'position_name'=>'Other', 
			],
     	];
    	DB::table('position')->insert($position);
    }
}
