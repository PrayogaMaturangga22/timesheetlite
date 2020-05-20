<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
    	DB::table('registered_user')->truncate();
    	DB::table('registered_user_detail')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=0; ');

        $this->call(Subscription_StatusSeeder::class);

        $this->call(CompanySeeder::class);
        $this->call(summarized_tableSeeder::class);
        $this->call(PullDataSeeder::class);       
        
        $this->call(Price_HistorySeeder::class);       
        $this->call(PricingSeeder::class);       

        $this->call(UsersSeeder::class);
        $this->call(StaffSeeder::class);

        $this->call(LoginSeeder::class);

        $this->call(ContactSeeder::class);
        $this->call(Request_DemoSeeder::class);
        $this->call(SubscriberSeeder::class);

        $this->call(PaymentRequestSeeder::class);
        $this->call(PaymentSeeder::class);

    	DB::statement('SET FOREIGN_KEY_CHECKS=1; ');
    }
}
