<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class PaymentSeeder extends Seeder
{
    public function run()
    {
    	DB::table('payment')->truncate();

    	$payment = [
	    	[
                'token'=>'9237492734972374dsdgfgerw8tghn9589n894tgn945y', 
                'payment_start'=>'2020-06-09',
                'payment_end'=>'2020-07-09',
                'trial_start'=>'2020-05-08',
                'trial_end'=>'2020-06-08',
                'feature_type'=>'premium',
                'payment_duration'=>'monthly',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
	    	[
                'token'=>'0784936487673864758673h4t87h3874btbvfdr7b23r', 
                'payment_start'=>'2020-06-09',
                'payment_end'=>'2020-07-09',
                'trial_start'=>'2020-05-08',
                'trial_end'=>'2020-06-08',
                'feature_type'=>'free',
                'payment_duration'=>'monthly',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
	    	[
                'token'=>'095m345n9374n5v987n3945n9435v68945n9340n7a1vv', 
                'payment_start'=>'2020-06-09',
                'payment_end'=>'2020-07-09',
                'trial_start'=>'2020-05-08',
                'trial_end'=>'2020-06-08',
                'feature_type'=>'free',
                'payment_duration'=>'monthly',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
     	];
    	DB::table('payment')->insert($payment);
    }
}
