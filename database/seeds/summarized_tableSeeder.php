<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class summarized_tableSeeder extends Seeder
{
    public function run()
    {
    	DB::table('summarized_table')->truncate();

    	$summarized_table = [
	    	[
				'column_name'=>'V1', 
				'total'=>'8', 
				'color_code'=>'',				
				'column_desc'=>'Total Users',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
			],
	    	[
				'column_name'=>'V2', 
				'total'=>'6', 
				'color_code'=>'',				
				'column_desc'=>'Total Company',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
	    	[
				'column_name'=>'V3', 
				'total'=>'2', 
				'color_code'=>'',				
				'column_desc'=>'Total Payment Request Issued',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
	    	[
				'column_name'=>'V4', 
				'total'=>'1', 
				'color_code'=>'',				
				'column_desc'=>'Total Receipt Issued',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],

			[
				'column_name'=>'UT1', 
				'total'=>'5', 
				'color_code'=>'#663399',				
				'column_desc'=>'Total Premium Users',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
	    	[
				'column_name'=>'UT2', 
				'total'=>'1', 
				'color_code'=>'#4CAF50',				
				'column_desc'=>'Total Trial Users',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
	    	[
				'column_name'=>'UT3', 
				'total'=>'2', 
				'color_code'=>'#F44336',				
				'column_desc'=>'Total Free Users',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],

			[
				'column_name'=>'EPW1', 
				'total'=>'3', 
				'color_code'=>'#FFC107',				
				'column_desc'=>'This Week',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
	    	[
				'column_name'=>'EPW2', 
				'total'=>'2', 
				'color_code'=>'#4CAF50',				
				'column_desc'=>'Next Week',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
			[
				'column_name'=>'EPM1', 
				'total'=>'5', 
				'color_code'=>'#663399',				
				'column_desc'=>'This Month',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
	    	[
				'column_name'=>'EPM2', 
				'total'=>'4', 
				'color_code'=>'#F44336',				
				'column_desc'=>'Next Month',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],

			[
				'column_name'=>'UA1', 
				'total'=>'2', 
				'color_code'=>'#4CAF50',
				'column_desc'=>'Less 21',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
	    	[
				'column_name'=>'UA2', 
				'total'=>'3', 
				'color_code'=>'#F44336',				
				'column_desc'=>'21 - 30',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
	    	[
				'column_name'=>'UA3', 
				'total'=>'1', 
				'color_code'=>'#FFC107',
				'column_desc'=>'31 - 40',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
	    	[
				'column_name'=>'UA4', 
				'total'=>'2', 
				'color_code'=>'#663399',
				'column_desc'=>'More 40',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],

			[
				'column_name'=>'UC1', 
				'total'=>'6', 
				'color_code'=>'#4CAF50',
				'column_desc'=>'Check In',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
	    	[
				'column_name'=>'UC2', 
				'total'=>'2', 
				'color_code'=>'#F44336',				
				'column_desc'=>'Not Check In',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],

			[
				'column_name'=>'UH1', 
				'total'=>'5', 
				'color_code'=>'#4CAF50',
				'column_desc'=>'Normal',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
	    	[
				'column_name'=>'UH2', 
				'total'=>'2', 
				'color_code'=>'#F44336',				
				'column_desc'=>'PDP',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
	    	[
				'column_name'=>'UH3', 
				'total'=>'1', 
				'color_code'=>'#FFC107',
				'column_desc'=>'Positif',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],

			[
				'column_name'=>'UG1', 
				'total'=>'5', 
				'color_code'=>'#4CAF50',
				'column_desc'=>'Male',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
	    	[
				'column_name'=>'UG2', 
				'total'=>'3', 
				'color_code'=>'#663399',
				'column_desc'=>'Female',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],

	    	[
				'column_name'=>'US1', 
                'total'=>'20', 
				'color_code'=>'#4CAF50',
				'column_desc'=>'Active',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
	    	[
				'column_name'=>'US2', 
				'total'=>'3', 
				'color_code'=>'#663399',
				'column_desc'=>'Inactive',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
		];
    	DB::table('summarized_table')->insert($summarized_table);
    }
}
