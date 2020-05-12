<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class StaffSeeder extends Seeder
{
    public function run()
    {
    	DB::table('public_staff')->truncate();

    	$staff = [
	    	[
				'user_id'=>'1', 
				'company_id'=>'1', 
				'position'=> 'Ketua', 
				'superior_id'=>'0', 
				'full_name'=>'Maju Sukses Sejahtera 1', 
				'gender'=>'male', 
				'address'=>'Denpasar Barat 1', 
				'phone_number'=>'93458638562', 
				'date_of_birth'=>'1987-01-01', 
				'image_profile'=>'', 
				'health_condition'=>'Normal', 
				'wfh_status'=>'0', 
				'total_task'=>'0', 
				'total_task_done'=>'0',
				'created_at' => '2020-05-05',
				'updated_at' => '2020-05-05' 
			],
	    	[
				'user_id'=>'2', 
				'company_id'=>'1', 
				'position'=> 'Other', 
				'superior_id'=>'1', 
				'full_name'=>'Maju Sukses Sejahtera 2', 
				'gender'=>'female', 
				'address'=>'Denpasar Barat 1', 
				'phone_number'=>'38456386544', 
				'date_of_birth'=>'1995-01-01', 
				'image_profile'=>'', 
				'health_condition'=>'PDP', 
				'wfh_status'=>'0', 
				'total_task'=>'0', 
				'total_task_done'=>'0',
				'created_at' => '2020-05-05',
				'updated_at' => '2020-05-05'
			],
	    	[
				'user_id'=>'3', 
				'company_id'=>'1', 
				'position'=> 'Other', 
				'superior_id'=>'1', 
				'full_name'=>'Maju Sukses Sejahtera 3', 
				'gender'=>'male', 
				'address'=>'Denpasar Barat 1', 
				'phone_number'=>'94872634862', 
				'date_of_birth'=>'1994-01-01', 
				'image_profile'=>'', 
				'health_condition'=>'Positif', 
				'wfh_status'=>'0', 
				'total_task'=>'0', 
				'total_task_done'=>'0',
				'created_at' => '2020-05-07',
				'updated_at' => '2020-05-07'
			],
	    	[
				'user_id'=>'4', 
				'company_id'=>'2', 
				'position'=> 'Ketua', 
				'superior_id'=>'0', 
				'full_name'=>'Megah Karya Surya 1', 
				'gender'=>'male', 
				'address'=>'Denpasar Timur 1', 
				'phone_number'=>'93648764345', 
				'date_of_birth'=>'1960-01-01', 
				'image_profile'=>'', 
				'health_condition'=>'Normal', 
				'wfh_status'=>'0', 
				'total_task'=>'0', 
				'total_task_done'=>'0',
				'created_at' => '2020-05-07',
				'updated_at' => '2020-05-07'
			],
	    	[
				'user_id'=>'5', 
				'company_id'=>'2', 
				'position'=> 'Other', 
				'superior_id'=>'4', 
				'full_name'=>'Megah Karya Surya 2', 
				'gender'=>'female', 
				'address'=>'Denpasar Timur 1', 
				'phone_number'=>'00903402344', 
				'date_of_birth'=>'2000-01-01', 
				'image_profile'=>'', 
				'health_condition'=>'PDP', 
				'wfh_status'=>'0', 
				'total_task'=>'0', 
				'total_task_done'=>'0',
				'created_at' => '2020-05-07',
				'updated_at' => '2020-05-07' 
			],
	    	[
				'user_id'=>'6', 
				'company_id'=>'3', 
				'position'=> 'Ketua', 
				'superior_id'=>'0', 
				'full_name'=>'Aman Jaya Keramik 1', 
				'gender'=>'male', 
				'address'=>'Denpasar Timur 1', 
				'phone_number'=>'34534534534', 
				'date_of_birth'=>'1962-01-01', 
				'image_profile'=>'', 
				'health_condition'=>'Normal', 
				'wfh_status'=>'0', 
				'total_task'=>'0', 
				'total_task_done'=>'0',
				'created_at' => '2020-05-06',
				'updated_at' => '2020-05-06'
			],
	    	[
				'user_id'=>'7', 
				'company_id'=>'3', 
				'position'=> 'Other', 
				'superior_id'=>'6', 
				'full_name'=>'Aman Jaya Keramik 2', 
				'gender'=>'male', 
				'address'=>'Denpasar Timur 1', 
				'phone_number'=>'54456456462', 
				'date_of_birth'=>'1986-01-01', 
				'image_profile'=>'', 
				'health_condition'=>'Normal', 
				'wfh_status'=>'0', 
				'total_task'=>'0', 
				'total_task_done'=>'0',
				'created_at' => '2020-05-11',
				'updated_at' => '2020-05-11'
			],
	    	[
				'user_id'=>'8', 
				'company_id'=>'3', 
				'position'=> 'Other', 
				'superior_id'=>'6', 
				'full_name'=>'Aman Jaya Keramik 3', 
				'gender'=>'female', 
				'address'=>'Denpasar Timur 1', 
				'phone_number'=>'43534534345', 
				'date_of_birth'=>'2000-01-01', 
				'image_profile'=>'', 
				'health_condition'=>'Normal', 
				'wfh_status'=>'0', 
				'total_task'=>'0', 
				'total_task_done'=>'0',
				'created_at' => '2020-05-11',
				'updated_at' => '2020-05-11' 
			],
     	];
    	DB::table('public_staff')->insert($staff);
    }
}
