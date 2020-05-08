<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class PaymentRequestSeeder extends Seeder
{
    public function run()
    {
    	DB::table('payment_request')->truncate();

    	$payment_request = [
	    	[
				'company_id'=>'1', 
				'pricing'=>'50000', 
				'duration'=>'1', 
                'sub_total'=>'50000', 
                'discount'=>'5000', 
                'grand_total'=>'45000', 
                'status'=>'1', 
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
			],
	    	[
				'company_id'=>'1', 
				'pricing'=>'60000', 
				'duration'=>'1', 
                'sub_total'=>'60000', 
                'discount'=>'6000', 
                'grand_total'=>'54000', 
                'status'=>'1', 
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
			],
	    	[
				'company_id'=>'2', 
				'pricing'=>'50000', 
				'duration'=>'1', 
                'sub_total'=>'50000', 
                'discount'=>'0', 
                'grand_total'=>'50000', 
                'status'=>'1', 
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
			],
            [
				'company_id'=>'3', 
				'pricing'=>'50000', 
				'duration'=>'1', 
                'sub_total'=>'50000', 
                'discount'=>'5000', 
                'grand_total'=>'45000', 
                'status'=>'0', 
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
			],
     	];
    	DB::table('payment_request')->insert($payment_request);
    }
}
