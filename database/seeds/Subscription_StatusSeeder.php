<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class Subscription_StatusSeeder extends Seeder
{
    public function run()
    {
        DB::table('subscription_status')->truncate();

        $subscription_status = [
            [
                'name' => 'Premium',
				'color_code'=>'#663399',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Free',
				'color_code'=>'#F44336',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Trial',
				'color_code'=>'#4CAF50',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
         ];
        DB::table('subscription_status')->insert($subscription_status);
    }
}