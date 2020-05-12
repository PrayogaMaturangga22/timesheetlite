<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class Price_HistorySeeder extends Seeder
{
    public function run()
    {
    	DB::table('price_history')->truncate();

    	$price_history = [
	    	[
                'change_date'=>carbon::now(),
                'from_price'=>'0',
                'to_price'=>'15000'
            ],
     	];
    	DB::table('price_history')->insert($price_history);
    }
}
