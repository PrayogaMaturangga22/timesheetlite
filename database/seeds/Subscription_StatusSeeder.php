<?php

use Illuminate\Database\Seeder;

class Subscription_StatusSeeder extends Seeder
{
    public function run()
    {
        DB::table('subscription_status')->truncate();

        $subscription_status = [
            [
                'name' => 'Premium',
				'color_code'=>'#663399', 
            ],
            [
                'name' => 'Free',
				'color_code'=>'#F44336', 
            ],
            [
                'name' => 'Trial',
				'color_code'=>'#4CAF50', 
            ],
         ];
        DB::table('subscription_status')->insert($subscription_status);
    }
}