<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\company;

use App\summarized_table;

use App\users;

use App\user_age;
use App\user_health;
use App\user_checkin;
use App\user_sex;

use App\user_status;
use App\expired_status;

use App\registered_user;
use Carbon\carbon;

class PagesController extends Controller
{
    public function users()
    {
        $users_list = users::all();

        return view('users', compact('users_list'));
    }

    public function index()
    {
        $fromdate = carbon::now()->addMonths(-1);
        $fromdate = substr($fromdate, 0, 10);

        $todate = carbon::now();
        $todate = substr($todate, 0, 10);

        $registered_user_list = registered_user::where('date', '>=', $fromdate)->where('date', '<=', $todate)->get();

        $fromdate = date_format(date_create($fromdate), "d-m-Y");
        $todate = date_format(date_create($todate), "d-m-Y");

        $totalusers = summarized_table::where('column_name', '=', 'V1')->first();
        $totalusers = $totalusers->total;
        $totalcompany = summarized_table::where('column_name', '=', 'V2')->get()->first();
        $totalcompany = $totalcompany->total;
        $totalpayment_request = summarized_table::where('column_name', '=', 'V3')->get()->first();
        $totalpayment_request = $totalpayment_request->total;
        $totalreceipt = summarized_table::where('column_name', '=', 'V4')->get()->first();
        $totalreceipt = $totalreceipt->total;

        $totalpremium = summarized_table::where('column_name', '=', 'V7')->first();
        $totalpremium = $totalpremium->total;
        $totaltrial = summarized_table::where('column_name', '=', 'V8')->first();
        $totaltrial = $totaltrial->total;
        $totalfree = summarized_table::where('column_name', '=', 'V9')->first();
        $totalfree = $totalfree->total;

        $company_list = company::all();

        $user_health_list = user_health::all();
        $user_sex_list = user_sex::all();
        $user_checkin_list = user_checkin::all();
        $user_age_list = user_age::all();

        $user_status_list = user_status::all();
        $expired_status_list = expired_status::all();

        return view('welcome', compact(
            'totalcompany', 
            'totalusers', 
            'totalpayment_request', 
            'totalreceipt',

            'company_list', 
            'totalpremium', 
            'totalfree', 
            'totaltrial',

            'user_health_list',
            'user_sex_list',
            'user_checkin_list',
            'user_age_list',

            'user_status_list',
            'expired_status_list',

            'registered_user_list',

            'fromdate',
            'todate'
        ));
    }
}
