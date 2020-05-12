<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class PricingSeeder extends Seeder
{
    public function run()
    {
    	DB::table('pricing')->truncate();

    	$pricing = [
	    	[
                'price'=>'15000',
            ],
     	];
    	DB::table('pricing')->insert($pricing);
    }
}
