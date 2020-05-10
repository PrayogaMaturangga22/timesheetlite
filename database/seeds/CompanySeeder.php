<?php

use Illuminate\Database\Seeder;
use Carbon\carbon;

class CompanySeeder extends Seeder
{
    public function run()
    {
    	DB::table('company')->truncate();

    	$company = [
	    	[
				'kode_perusahaan'=>'COMP-0001',
				'company_name'=>'PT. Maju Sukses Sejahtera', 
				'address'=>'Denpasar Barat', 
				'contact'=>'0872374862787', 
                'website'=>'www.majusuksessejahtera.com', 
                'password'=>'xa542j',
                'member_counter'=>'3',
                'registered_token'=>'9237492734972374dsdgfgerw8tghn9589n894tgn945y',
                'app_status'=>'1',
                'trial_kuota'=>'1',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
	    	[
				'kode_perusahaan'=>'COMP-0002',
				'company_name'=>'PT. Megah Karya Wisata', 
				'address'=>'Denpasar Timur', 
				'contact'=>'0943573745', 
                'website'=>'www.megahkaryawisata.com', 
                'password'=>'ksd663',
                'member_counter'=>'2',
                'registered_token'=>'0784936487673864758673h4t87h3874btbvfdr7b23r',
                'app_status'=>'1',
                'trial_kuota'=>'0',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
            [
				'kode_perusahaan'=>'COMP-0003',
				'company_name'=>'PT. Aman Jaya Keramik', 
				'address'=>'Denpasar Barat', 
				'contact'=>'037465637458345', 
                'website'=>'www.amanjayakeramik.com', 
                'password'=>'df787d',
                'member_counter'=>'3',
                'registered_token'=>'095m345n9374n5v987n3945n9435v68945n9340n7a1vv',
                'app_status'=>'0',
                'trial_kuota'=>'0',
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
				'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
     	];
    	DB::table('company')->insert($company);
    }
}
