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
				'color_code'=>'',				
				'column_desc'=>'Total Users', 
			],
	    	[
				'column_name'=>'V2', 
				'total'=>'6', 
				'color_code'=>'',				
				'column_desc'=>'Total Company', 
			],
	    	[
				'column_name'=>'V3', 
				'total'=>'2', 
				'color_code'=>'',				
				'column_desc'=>'Total Payment Request Issued', 
			],
	    	[
				'column_name'=>'V4', 
				'total'=>'1', 
				'color_code'=>'',				
				'column_desc'=>'Total Receipt Issued', 
			],

			[
				'column_name'=>'UT1', 
				'total'=>'5', 
				'color_code'=>'#663399',				
				'column_desc'=>'Total Premium Users', 
			],
	    	[
				'column_name'=>'UT2', 
				'total'=>'1', 
				'color_code'=>'#4CAF50',				
				'column_desc'=>'Total Trial Users', 
			],
	    	[
				'column_name'=>'UT3', 
				'total'=>'2', 
				'color_code'=>'#F44336',				
				'column_desc'=>'Total Free Users', 
			],

			[
				'column_name'=>'EP1', 
				'total'=>'10', 
				'color_code'=>'#FFC107',				
				'column_desc'=>'This Month', 
			],
	    	[
				'column_name'=>'EP2', 
				'total'=>'1', 
				'color_code'=>'#F44336',				
				'column_desc'=>'This Week', 
			],

			[
				'column_name'=>'UA1', 
				'total'=>'2', 
				'color_code'=>'#4CAF50',
				'column_desc'=>'19', 
			],
	    	[
				'column_name'=>'UA2', 
				'total'=>'3', 
				'color_code'=>'#F44336',				
				'column_desc'=>'20', 
			],
	    	[
				'column_name'=>'UA3', 
				'total'=>'1', 
				'color_code'=>'#FFC107',
				'column_desc'=>'22', 
			],
	    	[
				'column_name'=>'UA4', 
				'total'=>'2', 
				'color_code'=>'#663399',
				'column_desc'=>'24', 
			],

			[
				'column_name'=>'UC1', 
				'total'=>'6', 
				'color_code'=>'#4CAF50',
				'column_desc'=>'Check In', 
			],
	    	[
				'column_name'=>'UC2', 
				'total'=>'2', 
				'color_code'=>'#F44336',				
				'column_desc'=>'Not Check In', 
			],
	    	[
				'column_name'=>'UC3', 
				'total'=>'0', 
				'color_code'=>'#CFE4F3',
				'column_desc'=>'Break', 
			],

			[
				'column_name'=>'UH1', 
				'total'=>'5', 
				'color_code'=>'#4CAF50',
				'column_desc'=>'Normal', 
			],
	    	[
				'column_name'=>'UH2', 
				'total'=>'2', 
				'color_code'=>'#F44336',				
				'column_desc'=>'PDP', 
			],
	    	[
				'column_name'=>'UH3', 
				'total'=>'1', 
				'color_code'=>'#FFC107',
				'column_desc'=>'Positif', 
			],

			[
				'column_name'=>'UG1', 
				'total'=>'5', 
				'color_code'=>'#4CAF50',
				'column_desc'=>'Male', 
			],
	    	[
				'column_name'=>'UG1', 
				'total'=>'3', 
				'color_code'=>'#663399',
				'column_desc'=>'Female', 
			],

	    	[
				'column_name'=>'US1', 
                'total'=>'20', 
				'color_code'=>'#4CAF50',
				'column_desc'=>'Active', 
			],
	    	[
				'column_name'=>'US2', 
				'total'=>'3', 
				'color_code'=>'#663399',
				'column_desc'=>'Inactive', 
			],
		];
    	DB::table('summarized_table')->insert($summarized_table);
    }
}
