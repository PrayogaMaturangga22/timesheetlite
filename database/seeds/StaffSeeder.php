<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class StaffSeeder extends Seeder
{
    public function run()
    {
    	DB::table('staff')->truncate();

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
				'date_of_birth'=>'2000-01-01', 
				'image_profile'=>'', 
				'health_condition'=>'Normal', 
				'wfh_status'=>'0', 
				'total_task'=>'0', 
				'total_task_done'=>'0',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
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
				'date_of_birth'=>'2000-01-01', 
				'image_profile'=>'', 
				'health_condition'=>'PDP', 
				'wfh_status'=>'0', 
				'total_task'=>'0', 
				'total_task_done'=>'0',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
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
				'date_of_birth'=>'2000-01-01', 
				'image_profile'=>'', 
				'health_condition'=>'Positif', 
				'wfh_status'=>'0', 
				'total_task'=>'0', 
				'total_task_done'=>'0',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
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
				'date_of_birth'=>'2000-01-01', 
				'image_profile'=>'', 
				'health_condition'=>'Normal', 
				'wfh_status'=>'0', 
				'total_task'=>'0', 
				'total_task_done'=>'0',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
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
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
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
				'date_of_birth'=>'2000-01-01', 
				'image_profile'=>'', 
				'health_condition'=>'Normal', 
				'wfh_status'=>'0', 
				'total_task'=>'0', 
				'total_task_done'=>'0',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
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
				'date_of_birth'=>'2000-01-01', 
				'image_profile'=>'', 
				'health_condition'=>'Normal', 
				'wfh_status'=>'0', 
				'total_task'=>'0', 
				'total_task_done'=>'0',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
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
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
			],
     	];
    	DB::table('staff')->insert($staff);
    }
}
