<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS=0; ');

        $this->call(CompanySeeder::class);

        $this->call(summarized_tableSeeder::class);
        $this->call(User_AgeSeeder::class);
        $this->call(User_HealthSeeder::class);
        $this->call(User_CheckInSeeder::class);
        $this->call(User_SexSeeder::class);

        $this->call(Registered_UserSeeder::class);        

        $this->call(User_StatusSeeder::class);
        $this->call(Expired_StatusSeeder::class);

        $this->call(PositionSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(StaffSeeder::class);
    	
    	DB::statement('SET FOREIGN_KEY_CHECKS=1; ');
    }
}
