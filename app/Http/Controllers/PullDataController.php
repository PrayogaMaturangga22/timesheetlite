<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

use App\company;
use App\users;
use App\staff;
use App\pulldata;

use Carbon\carbon;

class PullDataController extends Controller
{
    public function getData(Request $request){

        $tablename = $request->datatable;

        $client = new \GuzzleHttp\Client();

        $res = $client->request('GET', 'https://my-json-server.typicode.com/PrayogaMaturangga22/json_db_timesheetlite/' . $tablename);

        $data_list = json_decode($res->getBody()->getContents());

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
                $data_array = [
                    'user_id' => $data->user_id,
                    'company_id' => $data->company_id,
                    'position' => $data->position,
                    'superior_id' => $data->superior_id,
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

        $pulldata = pulldata::where('table_name', '=', $tablename)->first();

        $pulldata->last_pull_date = carbon::now();

        $pulldata->update();

        return json_encode($pulldata);
    }
}
