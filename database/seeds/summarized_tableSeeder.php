<?php

use Illuminate\Database\Seeder;

class summarized_tableSeeder extends Seeder
{
    public function run()
    {
    	DB::table('summarized_table')->truncate();

    	$summarized_table = [
	    	[
				'column_name'=>'V1', 
				'total'=>'8', 
				'column_desc'=>'Total Users', 
			],
	    	[
				'column_name'=>'V2', 
				'total'=>'6', 
				'column_desc'=>'Total Company', 
			],
	    	[
				'column_name'=>'V3', 
				'total'=>'2', 
				'column_desc'=>'Total Payment Request Issued', 
			],
	    	[
				'column_name'=>'V4', 
				'total'=>'1', 
				'column_desc'=>'Total Receipt Issued', 
			],
	    	[
				'column_name'=>'V5', 
				'total'=>'6', 
				'column_desc'=>'Total Active Users', 
			],
	    	[
				'column_name'=>'V6', 
				'total'=>'2', 
				'column_desc'=>'Total Inactive Users', 
			],
	    	[
				'column_name'=>'V7', 
				'total'=>'5', 
				'column_desc'=>'Total Premium Users', 
			],
	    	[
				'column_name'=>'V8', 
				'total'=>'1', 
				'column_desc'=>'Total Trial Users', 
			],
	    	[
				'column_name'=>'V9', 
				'total'=>'2', 
				'column_desc'=>'Total Free Users', 
			],
     	];
    	DB::table('summarized_table')->insert($summarized_table);
    }
}
