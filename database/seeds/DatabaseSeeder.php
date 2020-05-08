<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS=0; ');

        $this->call(Subscription_StatusSeeder::class);

        $this->call(CompanySeeder::class);
        $this->call(summarized_tableSeeder::class);
        $this->call(Registered_UserSeeder::class);        
        $this->call(Registered_User_DetailSeeder::class);       
        $this->call(PullDataSeeder::class);       
        
        $this->call(PositionSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(StaffSeeder::class);

        $this->call(PaymentRequestSeeder::class);
        $this->call(PaymentSeeder::class);

    	DB::statement('SET FOREIGN_KEY_CHECKS=1; ');
    }
}
