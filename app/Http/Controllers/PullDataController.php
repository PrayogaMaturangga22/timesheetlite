<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

use App\company;
use App\users;
use App\staff;
use App\payment;
use App\payment_request;

use App\pulldata;

use App\summarized_table;
use App\registered_user;
use App\registered_user_detail;

use Carbon\carbon;

use DB;

class PullDataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getData(Request $request){

        $tablename = $request->datatable;

        $client = new \GuzzleHttp\Client();

        $key = config('app.datacenter_api_key');

        $URL = config('app.url_services2');

        // $res = $client->request('GET', 'https://my-json-server.typicode.com/PrayogaMaturangga22/json_db_timesheetlite/' . $tablename);

        if ($tablename == "users"){
            $res = $client->request('GET', $URL . '/services/db-timesheet-lite/' . $tablename, ['query' => ['key' => $key]]);
        }else{
            $res = $client->request('GET', $URL . '/services/db-timesheet-lite/tb_' . $tablename, ['query' => ['key' => $key]]);
        }

        $data_list = json_decode($res->getBody()->getContents());

        // --- Insert or Update data to main table ---
        if ($tablename == "company"){
            foreach($data_list as $data){
                $data_array = [
                    'kode_perusahaan' => $data->kode_perusahaan,
                    'company_name' => $data->company_name,
                    'address' => $data->address,
                    'contact' => $data->contact,
                    'website' => $data->website,
                    'password' => $data->password,
                    'member_counter' => $data->member_counter,
                    'registered_token' => $data->registered_token,
                    'app_status' => $data->app_status,
                    'trial_kuota' => $data->trial_kuota,
                    'updated_at' => carbon::now(),
                ];
    
                $company = company::where('registered_token', '=', $data->registered_token)->first();
    
                if ($company == null){
                    $company = company::create($data_array);
                }else{
                    $company = company::findOrFail($company->id);
    
                    $company->update($data_array);
                }

                // ---- buat payment untuk company yang belum ada data paymentnya ----
                $no_payment_company_list = DB::table("public_company")->select('*')->whereNotIn('registered_token',function($query) {
                                                $query->select('token')->from('payment');
                                            })->where('id', '=', $company->id)->get();
                
                foreach($no_payment_company_list as $no_payment_company){
                    $data_array = [
                        'token' => $data->registered_token,
                        'payment_start' => carbon::now()->format('Y-m-d'),
                        'payment_end' => carbon::now()->addMonths(1)->format('Y-m-d'),
                        'trial_start' => carbon::now()->format('Y-m-d'),
                        'trial_end' => carbon::now()->format('Y-m-d'),
                        'feature_type' => 'free',
                        'payment_duration' => 'monthly',
                    ];            

                    $payment = payment::create($data_array);
                }
                // ---------------------------------------------------------------------

            }
        }else if($tablename == "users"){
            foreach($data_list as $data){
                $data_array = [
                    'username' => $data->username,
                    'email' => $data->email,
                    'password' => $data->password,
                    'pin' => $data->pin,
                    'imei' => $data->imei,
                    'device_name' => $data->device_name,
                    'user_status' => $data->user_status,
                    'updated_at' => carbon::now(),
                ];
    
                $users = users::where('username', '=', $data->username)->first();
    
                if ($users == null){
                    $users = users::create($data_array);
                }else{
                    $users = users::findOrFail($users->id);
    
                    $users->update($data_array);
                }
            }
        }else if($tablename == "staff"){
            foreach($data_list as $data){

                // GET ID FROM CODE // COMPANY

                $company_id = company::where('kode_perusahaan', '=', $data->company_id)->first()->id;

                // ---------------

                // GET ID FROM EMAIL // SUPERIOR

                if ($data->superior_id == null){
                    $superior_id = null;
                }else{
                    $superior_id = users::where('email', '=', $data->superior_id)->first()->id;
                }


                // ---------------

                // GET ID FROM EMAIL // USER

                $user_id = users::where('email', '=', $data->user_id)->first()->id;

                // ---------------

                $data_array = [
                    'user_id' => $user_id,
                    'company_id' => $company_id,
                    'position' => $data->position,
                    'superior_id' => $superior_id,
                    'full_name' => $data->full_name,
                    'gender' => $data->gender,
                    'address' => $data->address,
                    'phone_number' => $data->phone_number,
                    'date_of_birth' => $data->date_of_birth,
                    'image_profile' => $data->image_profile,
                    'health_condition' => $data->health_condition,
                    'wfh_status' => $data->wfh_status,
                    'total_task' => $data->total_task,
                    'total_task_done' => $data->total_task_done,
                    'updated_at' => carbon::now(),
                ];
    
                $staff = staff::where('user_id', '=', $data->user_id)->first();
    
                if ($staff == null){
                    $staff = staff::create($data_array);
                }else{
                    $staff = staff::findOrFail($staff->id);
    
                    $staff->update($data_array);
                }
            }
        }
        // ---------------------------------------------


        // ---- calculate data to show to dashboard ----

        $this->CalculateTotal();
        $this->CalculateUserSubscribe();
        $this->CalculateUserAge();
        $this->CalculateUserCheckIn();
        $this->CalculateUserGender();
        $this->CalculateUserHealthCondition();
        $this->CalculateUserActive();
        $this->CalculateExpiredWeek();
        $this->CalculateExpiredMonth();        
        
        $this->UpdateCompanyTotalMember();        

        $this->CalculateRegisterUsers();        
        $this->CalculateRegisterUsersDetail();        

        // ---------------------------------------------


        $pulldata = pulldata::where('table_name', '=', $tablename)->first();

        $pulldata->last_pull_date = carbon::now();

        $pulldata->update();

        return json_encode($pulldata);
    }

    public function recalculateData(Request $request){
        // ---- calculate data to show to dashboard ----

        $this->CalculateTotal();
        $this->CalculateUserSubscribe();
        $this->CalculateUserAge();
        $this->CalculateUserCheckIn();
        $this->CalculateUserGender();
        $this->CalculateUserHealthCondition();
        $this->CalculateUserActive();
        $this->CalculateExpiredWeek();
        $this->CalculateExpiredMonth();        
        
        $this->UpdateCompanyTotalMember();        

        $this->CalculateRegisterUsers();        
        $this->CalculateRegisterUsersDetail();        

        // ---------------------------------------------        

        return "success";
    }

    function CalculateTotal(){
        // ---- to summarized_table / summary total ------

        $V1 = summarized_table::where('column_name', '=', 'V1')->first();

        $total_user = users::count('id');

        $V1->total = $total_user;

        $V1->update();

        $V2 = summarized_table::where('column_name', '=', 'V2')->first();

        $total_user = company::count('id');

        $V2->total = $total_user;

        $V2->update();

        $V3 = summarized_table::where('column_name', '=', 'V3')->first();

        $total_user = payment_request::count('id');

        $V3->total = $total_user;

        $V3->update();

        $V4 = summarized_table::where('column_name', '=', 'V4')->first();

        $total_user = payment::count('id');

        $V4->total = $total_user;

        $V4->update();

        // --- end of summarized_table / summary total ---
    }

    public function CalculateUserSubscribe(){
        // ---- to summarized_table / users status subscribe ------

        $UT1 = summarized_table::where('column_name', '=', 'UT1')->first();

        $total_premium = staff::leftJoin('public_company', 'public_staff.company_id', '=', 'public_company.id')
                ->leftJoin('payment', 'public_company.registered_token', '=', 'payment.token')
                ->where('feature_type', '=', 'premium')
                ->count('public_staff.id');

        $UT1->total = $total_premium;

        $UT1->update();

        $UT2 = summarized_table::where('column_name', '=', 'UT2')->first();

        $total_trial = staff::leftJoin('public_company', 'public_staff.company_id', '=', 'public_company.id')
                ->leftJoin('payment', 'public_company.registered_token', '=', 'payment.token')
                ->where('feature_type', '=', 'free')->where('app_status', '=', '1')
                ->count('public_staff.id');

        $UT2->total = $total_trial;

        $UT2->update();

        $UT3 = summarized_table::where('column_name', '=', 'UT3')->first();

        $total_free = staff::leftJoin('public_company', 'public_staff.company_id', '=', 'public_company.id')
                ->leftJoin('payment', 'public_company.registered_token', '=', 'payment.token')
                ->where('app_status', '=', '0')
                ->count('public_staff.id');

        $UT3->total = $total_free;

        $UT3->update();

        // --- end of summarized_table / users status subscribe ---
    }

    public function CalculateUserAge(){
        // ---- to summarized_table / users age ------

        $UA1 = summarized_table::where('column_name', '=', 'UA1')->first();

        $total_under_21 = staff::whereRaw('TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) < 21')->count('id');

        $UA1->total = $total_under_21;

        $UA1->update();

        $UA2 = summarized_table::where('column_name', '=', 'UA2')->first();

        $total_between_21_and_30 = staff::whereRaw('TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) between 21 AND 30')->count('id');

        $UA2->total = $total_between_21_and_30;

        $UA2->update();

        $UA3 = summarized_table::where('column_name', '=', 'UA3')->first();

        $total_between_31_and_40 = staff::whereRaw('TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) between 31 AND 40')->count('id');

        $UA3->total = $total_between_31_and_40;

        $UA3->update();

        $UA4 = summarized_table::where('column_name', '=', 'UA4')->first();

        $total_more_40 = staff::whereRaw('TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) > 40')->count('id');

        $UA4->total = $total_more_40;

        $UA4->update();
        // --- end of summarized_table / users age ---
    }

    public function CalculateUserCheckIn(){
        // ---- to summarized_table / users check in ------

        $UC1 = summarized_table::where('column_name', '=', 'UC1')->first();

        $total_checkin = staff::where('wfh_status', '=', '1')->count('id');

        $UC1->total = $total_checkin;

        $UC1->update();

        $UC2 = summarized_table::where('column_name', '=', 'UC2')->first();

        $total_not_checkin = staff::where('wfh_status', '=', '0')->count('id');

        $UC2->total = $total_not_checkin;

        $UC2->update();

        // --- end of summarized_table / users check in ---
    }

    public function CalculateUserGender(){
        // ---- to summarized_table / users gender ------

        $UG1 = summarized_table::where('column_name', '=', 'UG1')->first();

        $total_male = staff::where('gender', '=', 'male')->count('id');

        $UG1->total = $total_male;

        $UG1->update();

        $UG2 = summarized_table::where('column_name', '=', 'UG2')->first();

        $total_female = staff::where('gender', '=', 'female')->count('id');

        $UG2->total = $total_female;

        $UG2->update();

        // --- end of summarized_table / users gender ---
    }

    public function CalculateUserHealthCondition(){
        // ---- to summarized_table / users health condition ------

        $UH1 = summarized_table::where('column_name', '=', 'UH1')->first();

        $total_normal = staff::where('health_condition', '=', 'Normal')->count('id');

        $UH1->total = $total_normal;

        $UH1->update();

        $UH2 = summarized_table::where('column_name', '=', 'UH2')->first();

        $total_pdp = staff::where('health_condition', '=', 'PDP')->count('id');

        $UH2->total = $total_pdp;

        $UH2->update();

        $UH3 = summarized_table::where('column_name', '=', 'UH3')->first();

        $total_positif = staff::where('health_condition', '=', 'Positif')->count('id');

        $UH3->total = $total_positif;

        $UH3->update();

        // --- end of summarized_table / users health condition ---
    }

    public function CalculateUserActive(){
        // ---- to summarized_table / users active ------

        $US1 = summarized_table::where('column_name', '=', 'US1')->first();

        $total_active = staff::leftJoin('public_company', 'public_company.id', '=', 'public_staff.company_id')->where('public_company.app_status', '=', '1')->count('public_staff.id');

        $US1->total = $total_active;

        $US1->update();

        $US2 = summarized_table::where('column_name', '=', 'US2')->first();

        $total_inactive = staff::leftJoin('public_company', 'public_company.id', '=', 'public_staff.company_id')->where('public_company.app_status', '=', '0')->count('public_staff.id');

        $US2->total = $total_inactive;

        $US2->update();

        // --- end of summarized_table / users active ---
    }

    public function CalculateExpiredWeek(){
        // ---- to summarized_table / users expired this / next week ------

        $EPW1 = summarized_table::where('column_name', '=', 'EPW1')->first();

        $total_expired_this_week = company::leftJoin('payment', 'payment.token', '=', 'public_company.registered_token')->where('payment.feature_type', '=', 'premium')->whereRaw('TIMESTAMPDIFF(DAY, `payment_end`, CURDATE()) <= 7')->count('public_company.id');

        $EPW1->total = $total_expired_this_week;

        $EPW1->update();

        $EPW2 = summarized_table::where('column_name', '=', 'EPW2')->first();

        $total_expired_next_week = company::leftJoin('payment', 'payment.token', '=', 'public_company.registered_token')->where('payment.feature_type', '=', 'premium')->whereRaw('TIMESTAMPDIFF(DAY, `payment_end`, CURDATE()) > 7 AND TIMESTAMPDIFF(DAY, `payment_end`, CURDATE()) <= 14')->count('public_company.id');

        $EPW2->total = $total_expired_next_week;

        $EPW2->update();

        // --- end of summarized_table / users expired this / next week ---
    }

    public function CalculateExpiredMonth(){
        // ---- to summarized_table / users expired this / next month ------

        $EPM1 = summarized_table::where('column_name', '=', 'EPM1')->first();

        $total_expired_this_month = company::leftJoin('payment', 'payment.token', '=', 'public_company.registered_token')->where('payment.feature_type', '=', 'premium')->whereRaw('TIMESTAMPDIFF(MONTH, `payment_end`, CURDATE()) <= 1')->count('public_company.id');

        $EPM1->total = $total_expired_this_month;

        $EPM1->update();

        $EPM2 = summarized_table::where('column_name', '=', 'EPM2')->first();

        $total_expired_next_month = company::leftJoin('payment', 'payment.token', '=', 'public_company.registered_token')->where('payment.feature_type', '=', 'premium')->whereRaw('TIMESTAMPDIFF(MONTH, `payment_end`, CURDATE()) > 1 AND TIMESTAMPDIFF(DAY, `payment_end`, CURDATE()) <= 2')->count('public_company.id');

        $EPM2->total = $total_expired_next_month;

        $EPM2->update();

        // --- end of summarized_table / users expired this / next month ---
    }

    public function UpdateCompanyTotalMember(){
        $member_counter_list = DB::select(DB::raw("
            SELECT a.company_id, COUNT(a.id) member_counter
            FROM public_staff a
            GROUP BY a.company_id        
        "));

        foreach($member_counter_list as $member_counter){
            $company = company::findOrFail($member_counter->company_id);
            $company->member_counter = $member_counter->member_counter;
            $company->update();
        }
    }

    public function CalculateRegisterUsers(){
        // ---- to summarized_table / registered users ------

        $register_user_list = DB::select(DB::raw("
            SELECT STR_TO_DATE(updated_at, '%Y-%m-%d') as register_date, COUNT(a.id) as register_user
            FROM public_staff a
            GROUP BY STR_TO_DATE(updated_at, '%Y-%m-%d')        
        "));

        foreach($register_user_list as $register_user){
            $registered_user = registered_user::where('date', '=', $register_user->register_date)->first();

            $data_array = [
                "date" => $register_user->register_date,
                "total" => $register_user->register_user
            ];

            if ($registered_user == null){
                $registered_user = registered_user::create($data_array);
            }else{
                $registered_user = registered_user::findOrFail($registered_user->id);
                
                $registered_user->update($data_array);
            }
        }

        // --- end of summarized_table / registered users ---
    }

    public function CalculateRegisterUsersDetail(){
        // ---- to summarized_table / registered users ------

        $register_user_detail_list = DB::select(DB::raw("
            SELECT IFNULL(SUM(a.member_counter), 0) member_counter, STR_TO_DATE(a.updated_at, '%Y-%m-%d') as register_date, 'premium' as status FROM public_company a
            INNER JOIN payment b ON a.registered_token = b.token
            WHERE b.feature_type = 'premium' AND a.app_status = 1
            GROUP BY STR_TO_DATE(a.updated_at, '%Y-%m-%d')
            
            UNION 
            
            SELECT IFNULL(SUM(a.member_counter), 0) member_counter, STR_TO_DATE(a.updated_at, '%Y-%m-%d') as register_date, 'trial' as status FROM public_company a
            INNER JOIN payment b ON a.registered_token = b.token
            WHERE b.feature_type = 'free' AND a.app_status = 1
            GROUP BY STR_TO_DATE(a.updated_at, '%Y-%m-%d')
            
            UNION
            
            SELECT IFNULL(SUM(a.member_counter), 0) member_counter, STR_TO_DATE(a.updated_at, '%Y-%m-%d') as register_date, 'free' as status FROM public_company a
            INNER JOIN payment b ON a.registered_token = b.token
            WHERE a.app_status = 0
            GROUP BY STR_TO_DATE(a.updated_at, '%Y-%m-%d')
        "));

        foreach($register_user_detail_list as $register_user_detail){
            $registered_user_detail = registered_user_detail::where('date', '=', $register_user_detail->register_date)->where('status', '=', $register_user_detail->status)->first();

            $data_array = [
                "date" => $register_user_detail->register_date,
                "status" => $register_user_detail->status,
                "total" => $register_user_detail->member_counter
            ];

            if ($registered_user_detail == null){
                $registered_user_detail = registered_user_detail::create($data_array);
            }else{
                $registered_user_detail = registered_user_detail::findOrFail($registered_user_detail->id);
                
                $registered_user_detail->update($data_array);
            }
        }

        // --- end of summarized_table / registered users ---
    }
}
